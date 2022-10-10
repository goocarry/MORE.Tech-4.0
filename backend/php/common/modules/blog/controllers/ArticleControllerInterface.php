<?php

namespace common\modules\blog\controllers;

/**
 * @OA\Tag(name="article", description="Управления модулем статей"),
 */
interface ArticleControllerInterface
{
    /**
     * @OA\Get(
     *     path="/blog/articles",
     *     description="Получение всех статей",
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"article"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionIndex();

    /**
     * @OA\Post(
     *     path="/blog/articles",
     *     description="Созадание статьи",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные статьи:",
     *         @OA\JsonContent(
     *             required={"title", "user_id"},
     *             @OA\Property(property="title", type="string", format="text", example="u1234567890"),
     *             @OA\Property(property="user_id", type="integer", format="text", example="1"),
     *             @OA\Property(property="photo", type="string", format="text", example="https://apply-moretech.vtb.ru/upload/logo-light.png"),
     *             @OA\Property(property="description", type="string", format="text", example="jsdf ksadbf sadb fkadsbfkj habsd jkf sfhb kauerybf kdbsv jhasdj kfbhas jkdfbh akjsdfhb jadhsbf jsdbf sdhbf khdsbf kjbhdsj fhbsdjkf hbsdkajfh bsdjkhf bsjdh fbksjdh fbjaksdhbf jksadhbf kds"),
     *             @OA\Property(property="categories", type="array",
     *                 @OA\Items(type="integer", format="text")
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"article"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionCreate();

    /**
     * @OA\Put(
     *     path="/blog/articles/{id}",
     *     description="Редактирование статьи",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id статьи",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные статьи:",
     *         @OA\JsonContent(
     *             required={"title", "user_id"},
     *             @OA\Property(property="title", type="string", format="text", example="u1234567890"),
     *             @OA\Property(property="user_id", type="integer", format="text", example="1"),
     *             @OA\Property(property="photo", type="string", format="text", example="https://apply-moretech.vtb.ru/upload/logo-light.png"),
     *             @OA\Property(property="description", type="string", format="text", example="jsdf ksadbf sadb fkadsbfkj habsd jkf sfhb kauerybf kdbsv jhasdj kfbhas jkdfbh akjsdfhb jadhsbf jsdbf sdhbf khdsbf kjbhdsj fhbsdjkf hbsdkajfh bsdjkhf bsjdh fbksjdh fbjaksdhbf jksadhbf kds"),
     *             @OA\Property(property="categories", type="array",
     *                 @OA\Items(type="integer", format="text")
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"article"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionUpdate($id);

    /**
     * @OA\Get(
     *     path="/blog/articles/{id}",
     *     description="Получение статьи",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id статьи",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"article"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionView($id);

    /**
     * @OA\Delete(
     *     path="/blog/articles/{id}",
     *     description="Удаление статьи",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id статьи",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"article"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionDelete($id);
}