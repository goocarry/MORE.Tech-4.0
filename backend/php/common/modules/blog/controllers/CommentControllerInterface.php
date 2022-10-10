<?php

namespace common\modules\blog\controllers;

/**
 * @OA\Tag(name="comment", description="Управления модулем комментариев"),
 */
interface CommentControllerInterface
{
    /**
     * @OA\Get(
     *     path="/blog/comments?article_id={article_id}",
     *     @OA\Parameter(
     *         required=true,
     *         name="article_id",
     *         in="query",
     *         description="Id статьи",
     *         @OA\Schema(type="integer")
     *     ),
     *     description="Получение всех комментариев для одной статьи",
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"comment"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionIndex();

    /**
     * @OA\Post(
     *     path="/blog/comments",
     *     description="Созадание комментария",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные комментария:",
     *         @OA\JsonContent(
     *             required={"text", "user_id", "article_id"},
     *             @OA\Property(property="text", type="string", format="text", example="Текст комментария"),
     *             @OA\Property(property="user_id", type="integer", format="text", example="1"),
     *             @OA\Property(property="article_id", type="integer", format="text", example="1"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"comment"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionCreate();

    /**
     * @OA\Put(
     *     path="/blog/comments/{id}",
     *     description="Редактирование комментария",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id комментария",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные комментария:",
     *         @OA\JsonContent(
     *             required={"text", "user_id", "article_id"},
     *             @OA\Property(property="text", type="string", format="text", example="Текст комментария"),
     *             @OA\Property(property="user_id", type="integer", format="text", example="1"),
     *             @OA\Property(property="article_id", type="integer", format="text", example="1"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"comment"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionUpdate($id);

    /**
     * @OA\Get(
     *     path="/blog/comments/{id}",
     *     description="Получение комментария",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id комментария",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"comment"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionView($id);

    /**
     * @OA\Delete(
     *     path="/blog/comments/{id}",
     *     description="Удаление комментария",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id комментария",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"comment"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionDelete($id);
}