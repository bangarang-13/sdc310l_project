<?php

require_once __DIR__ . "/config/db.php";

require_once __DIR__ . "/app/controllers/CatalogController.php";
require_once __DIR__ . "/app/controllers/CartController.php";

$controller = $_GET['controller'] ?? 'catalog';
$action     = $_GET['action'] ?? 'index';

switch ($controller) {

    case 'cart':
        $cartController = new CartController();

        switch ($action) {

            case 'add':
                $cartController->add();
                break;

            case 'view':
                $cartController->view();
                break;

            case 'update':
                $cartController->update();
                break;

            case 'remove':
                $cartController->remove();
                break;

            case 'clear':
                $cartController->clear();
                break;

            case 'checkout':
                $cartController->checkout(); // ✅ keeps logic in controller
                break;

            default:
                header("Location: index.php");
                exit();
        }
        break;

    case 'catalog':
    default:
        $catalogController = new CatalogController();
        $catalogController->index();
        break;
}