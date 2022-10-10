<?php

namespace common\modules\task\controllers;

/**
 * @OA\Tag(name="task", description="Управления модулем задач"),
 */
interface TaskControllerInterface
{
    /**
     * @OA\Get(
     *     path="/task/tasks",
     *     description="Получение всех задач",
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"task"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionIndex();

    /**
     * @OA\Post(
     *     path="/task/tasks",
     *     description="Созадание задачи",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные задачи:",
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
     *     tags={"task"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionCreate();

    /**
     * @OA\Put(
     *     path="/task/tasks/{id}",
     *     description="Редактирование задачи",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id задачи",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Отправьте данные задачи:",
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
     *     tags={"task"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionUpdate($id);

    /**
     * @OA\Get(
     *     path="/task/tasks/{id}",
     *     description="Получение задачи",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id задачи",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"task"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionView($id);

    /**
     * @OA\Delete(
     *     path="/task/tasks/{id}",
     *     description="Удаление задачи",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id задачи",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Успешный ответ"),
     *     security={{"bearerAuth":{}}}, 
     *     tags={"task"},
     *     @OA\Response(response=401, description="Unauthorized"),
     * ),
     */
    public function actionDelete($id);
}