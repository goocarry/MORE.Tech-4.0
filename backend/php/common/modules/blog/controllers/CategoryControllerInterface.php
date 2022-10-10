<?php

namespace common\modules\blog\controllers;

/**
 * @OA\Tag(name="category", description="Управления модулем категорий"),
 */
interface CategoryControllerInterface
{
    /**
     * @OA\Get(
     *     path="/blog/categories",
     *     description="Получение всех категорий",
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"category"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionIndex();

    /**
     * @OA\Post(
     *     path="/blog/categories",
     *     description="Созадание категории",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные категории:",
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", format="text", example="Категория 1"),
     *             @OA\Property(property="photo", type="string", format="text", example="https://apply-moretech.vtb.ru/upload/logo-light.png"),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"category"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionCreate();

    /**
     * @OA\Put(
     *     path="/blog/categories/{id}",
     *     description="Редактирование категории",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id категории",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные категории:",
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", format="text", example="Категория 1"),
     *             @OA\Property(property="photo", type="string", format="text", example="https://apply-moretech.vtb.ru/upload/logo-light.png"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"category"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionUpdate($id);

    /**
     * @OA\Get(
     *     path="/blog/categories/{id}",
     *     description="Получение категории",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id категории",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"category"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionView($id);

    /**
     * @OA\Delete(
     *     path="/blog/categories/{id}",
     *     description="Удаление категории",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id категории",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"category"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionDelete($id);
}