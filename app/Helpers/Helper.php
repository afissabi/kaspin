<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Master\M_menu;
use App\Models\Master\M_menu_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Helper
{
    public static function menuAllowTo()
    {   
        $recursiveMenu = M_menu_user::where('id_user', session('user')->id_user)->join('m_menu','m_menu.id_menu','=', 'm_menu_user.id_menu')->where('m_menu.deleted_at',null)->orderBy('m_menu.urutan','ASC')->get();

        $html = "";
        foreach ($recursiveMenu as $value) {
            $menu = M_menu::where('id_menu',$value->id_menu)->first();
            $currentURL = url()->full();

            if($menu->status == 0){
                if (strpos($currentURL, strtolower($menu->url_menu)) != false) {
                    $active = 'active';
                }else{
                    $active = '';
                }

                $html .= '
                <div class="menu-item">
                    <a class="menu-link ' . $active . '" href="' . url("$value->url_menu") . '">
                        <span class="menu-icon">
                            <i class="' . $value->icon . ' fs-3"></i>
                        </span>
                        <span class="menu-title">' . $menu->nama_menu . '</span>
                    </a>
                </div>';
            }elseif($menu->status == 1){
                if (strpos($currentURL, strtolower($menu->url_menu)) != false) {
                    $here = 'here show';
                } else {
                    $here = '';
                }

                $html .= '<div data-kt-menu-trigger="click" class="menu-item menu-accordion ' . $here . '">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="' . $menu->icon . ' fs-3"></i>
                                </span>
                                <span class="menu-title">' . $menu->nama_menu . '</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">';
                            
                            $sub = M_menu_user::where('id_user', session('user')->id_user)->where('parent_id', $value->id_menu)->join('m_menu', 'm_menu.id_menu', '=', 'm_menu_user.id_menu')->where('status', 3)->orderBy('m_menu.urutan', 'ASC')->get();

                            // if($sub != null){
                                foreach ($sub as $item) {
                                    if (strpos($currentURL, strtolower($item->url_menu)) != false) {
                                        $heres = 'here show';
                                    } else {
                                        $heres = '';
                                    }

                                    $html .= '<div data-kt-menu-trigger="click" class="menu-item menu-accordion ' . $heres . '">
                                                    <span class="menu-link">
                                                        <span class="menu-icon">
                                                            <i class="' . $item->icon . ' fs-3"></i>
                                                        </span>
                                                        <span class="menu-title">' . $item->nama_menu . '</span>
                                                        <span class="menu-arrow"></span>
                                                    </span>
                                                    <div class="menu-sub menu-sub-accordion menu-active-bg">';

                                    $subchild = M_menu_user::where('id_user', session('user')->id_user)->where('sub_parent_id', $item->id_menu)->join('m_menu', 'm_menu.id_menu', '=', 'm_menu_user.id_menu')->where('status', 4)->orderBy('m_menu.urutan', 'ASC')->get();

                                    foreach ($subchild as $item) {

                                        if (strpos($currentURL, strtolower($item->url_menu)) != false) {
                                            $activechild = 'active';
                                        } else {
                                            $activechild = '';
                                        }

                                        $html .= '<div class="menu-item">
                                                                <a class="menu-link ' . $activechild . '" href="' . url("$item->url_menu") . '">
                                                                    <span class="menu-bullet">
                                                                        <span class="bullet bullet-dot"></span>
                                                                    </span>
                                                                    <span class="menu-title">' . $item->nama_menu . '</span>
                                                                </a>
                                                            </div>';
                                    }
                                }
                            
                                $html .= '</div></div>';
                            // }

                            $child = M_menu_user::where('id_user', session('user')->id_user)->where('parent_id', $value->id_menu)->join('m_menu', 'm_menu.id_menu', '=', 'm_menu_user.id_menu')->where('status', 2)->orderBy('m_menu.urutan', 'ASC')->get();
                                
                            foreach ($child as $item) {

                                if (strpos($currentURL, strtolower($item->url_menu)) != false) {
                                    $activechild = 'active';
                                } else {
                                    $activechild = '';
                                }

                                $html .= '<div class="menu-item">
                                        <a class="menu-link ' . $activechild . '" href="' . url("$item->url_menu") . '">
                                            <span class="menu-icon">
                                                <i class="' . $item->icon . ' fs-3"></i>
                                            </span>
                                            <span class="menu-title">' . $item->nama_menu . '</span>
                                        </a>
                                    </div>';
                            }

                $html .= '</div>';
            }
        }

        return $html;
    }
}
