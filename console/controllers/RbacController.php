<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
        
        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $manager = $auth->createRole('manager');
        
        // запишем их в БД
        $auth->add($admin);
        $auth->add($manager);
        
        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewCrudUser = $auth->createPermission('viewCrudUser');
        $viewCrudUser->description = 'Просмотр старницы с пользователями';

        $viewCrudClients = $auth->createPermission('viewCrudClients');
        $viewCrudClients->description = 'Просмотр старницы с клиентами';
        //$updateNews = $auth->createPermission('updateNews');
        //$updateNews->description = 'Редактирование новости';
        
        // Запишем эти разрешения в БД
        $auth->add($viewCrudUser);
        $auth->add($viewCrudClients);
        
        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateNews,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage
        
        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»
        //$auth->addChild($editor,$updateNews);
        $auth->addChild($manager,$viewCrudClients);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $manager);
        
        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewCrudUser);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1); 
        
        // Назначаем роль editor пользователю с ID 2
        $auth->assign($manager, 2);
    }
}