<?php
/**
 * Базовый контролер для всех контролеров управления блогом
 * в панели администратора
 * (должен быть родителем всех контролеров управления блогом)
 * @package App\Http\Controllers\Blog\Admin
 * **/

namespace App\Http\Controllers\Blog\Admin;
use App\Http\Controllers\Blog\BaseController as GuestBaseController;

abstract class BaseController extends GuestBaseController
{
	/**
	 * BaseController constructor.
	 */
	public function __construct()
	{
		// Инициализация общих моментов для админ-части
	}
}
