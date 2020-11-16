<?php

namespace App\Http\Controllers;

use App\Helpers\MailerFactory;

use App\Helpers\SiteHelper;

use App\Models\Page;

use Illuminate\Http\Request;

class SiteController extends Controller
{

    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTestEmail()
    {   
        $mailTo = 'vanok.susanin@gmail.com';
        $data['phone'] = '+375297782885';
        $data['email'] = 'email@tututu.by'
        $data['message'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        $this->mailer->sendCallbackEmail($mailTo, "Email callback subject", $data);
    }


    /**
     *  Show home page
     */
    public function index()
    {
    	$data = Page::where('type', 7)->first();
        return view('site.index', compact('data'));
    }

    /**
     *  Show pages
     */

    public function page(Request $request)
    {
    	$uri = $request->path();
    	$data = Page::where('path', $uri)->first();

        PageTypeFactory::view($data->type);



        // switch ($data->type) {

        //     case 1:  /** standart page **/
        //         return view('site.standart_page', compact('data'));
        //     break;

        //     case 2:  /** page with sidebar **/
        //         return view('site.sidebar_page', compact('data'));
        //     break;

        //     case 3:  /** page list **/
        //         return view('site.page_list', compact('data'));
        //     break;

        //     case 4:  /** page contact **/
        //         return view('site.page_contact', compact('data'));
        //     break;

        //     case 5:  /** page contact **/
        //         return view('site.page_blog', compact('data'));
        //     break;

        //     case 6:  /** page portfolio **/
        //         return view('site.page_portfolio', compact('data'));
        //     break;

        //     default:  /** page default **/
        //         return view('site.standart_page', compact('data'));
        //     break;
        // }







        
    }

}
