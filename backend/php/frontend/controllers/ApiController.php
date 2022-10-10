<?php

namespace frontend\controllers;

use Yii;
use yii\rest\Controller;
use frontend\models\UserForm;
use common\models\User;
use bizley\jwt\JwtHttpBearerAuth;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use yii\filters\Cors;

/**
 * Api controller
 * @OA\Info(title="MoreTech api", version="0.1")
 * @OA\Tag(name="test", description="Тестовый экшн с аннотациями Swagger")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 */
class ApiController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Allow-Origin' => ['*'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Request-Methods' => ['*'],
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Max-Age' => 3600,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'test'  => ['GET', 'OPTIONS'],
                    'get-token'  => ['POST', 'OPTIONS'],
                ],
            ],
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/test",
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"test"}
     * ),
     * @OA\Response(response=401, description="Unauthorized"),
     */
    public function actionTest()
    {
        // Yii::$app->redis->set('mykey', 'some value 234234');
        $row = (new \yii\db\Query())
            ->select(['version'])
            ->from('migration')
            ->limit(10)
            ->one();
        return \frontend\responses\ApiResponseData::render([
            // 'redis' => Yii::$app->redis->get('mykey'),
            'db' => $row['version'],
            'uid' => Yii::$app->user->identity->username,
            'role' => Yii::$app->authManager->getRolesByUser(Yii::$app->user->id),
        ]);
    }

    /**
     * @OA\Post(
     *     description="Получение JWT токена",
     *     path="/api/get-token",
     *     tags={"auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте имя пользователя:",
     *         @OA\JsonContent(
     *             required={"username"},
     *             @OA\Property(property="username", type="string", format="text", example="u1234567890"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     * ),
     */
    public function actionGetToken()
    {
        $userForm = new UserForm();
        $userForm->attributes = Yii::$app->request->post();

        if ($userForm->validate()) {
            $user = User::findByUsername($userForm->username);
            if ($user === null)
            {
                $user = new User();
                $user->username = $userForm->username;
                $user->email = $userForm->username . '@api.api';
                $user->status = User::STATUS_ACTIVE;
                $user->setPassword('00000000');
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();
                $user->save();
            }
        } else {
            $this->errorValidate($userForm->errors, 'api/get-token');
        }

        $now = new \DateTimeImmutable();
        /** @var \Lcobucci\JWT\Token\Plain $token */
        $token = Yii::$app->jwt->getBuilder()
            // Configures the issuer (iss claim)
            ->issuedBy('http://localhost:3000')
            // Configures the audience (aud claim)
            ->permittedFor(substr(Yii::$app->params['domain'], 0, -1))
            // Configures the id (jti claim)
            ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issued (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($now->modify('+0 second'))
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+24 hour'))
            // Configures a new claim, called "uid"
            ->withClaim('uid', $user->username)
            // Configures a new header, called "foo"
            ->withHeader('foo', 'bar')
            // Builds a new token
            ->getToken(
                Yii::$app->jwt->getConfiguration()->signer(),
                Yii::$app->jwt->getConfiguration()->signingKey()
            );

        return \frontend\responses\TokenResponseData::render([
            'token' => $token->toString(),
            'user_id' => $user->id,
        ]);
    }

    /**
     * @param array|object|string $errorMessage
     * @param string $tag
     * @throws yii\web\HttpException If model has no valid data.
     */
    public function errorValidate($errorMessage, $tag)
    {
        Yii::error($errorMessage, $tag);
        throw new HttpException(422, json_encode($errorMessage));
    }
}
