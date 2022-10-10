<?php

namespace common\modules\blog\controllers;

/**
 * @OA\Tag(name="user-reaction", description="Управления модулем реакций от пользователей"),
 */
interface UserReactionControllerInterface
{
    /**
     * @OA\Post(
     *     path="/blog/user-reactions",
     *     description="Созадание реакции пользователя",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные реакции пользователя:",
     *         @OA\JsonContent(
     *             required={"user_id", "reaction_id"},
     *             @OA\Property(property="article_id", type="integer", format="text", example="1"),
     *             @OA\Property(property="comment_id", type="integer", format="text", example="1"),
     *             @OA\Property(property="user_id", type="integer", format="text", example="1"),
     *             @OA\Property(property="reaction_id", type="integer", format="text", example="1"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"user-reaction"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionCreate();
}