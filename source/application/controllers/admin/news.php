<?php
/**
 * User: Rogier
 * Date: 16-2-13
 * Time: 19:37
 *
 */
class Admin_News_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'mod');
    }

    public function get_index()
    {
        return Redirect::to('/admin/');
    }

    public function get_overview()
    {
        return View::make('page.admin.news.overview')
            ->with('news', News::order_by('created_at', 'DESC')->paginate(25));
    }

    public function get_new()
    {
            return View::make('page.admin.news.new');
    }

    public function post_new()
    {
        $new = new News;
        return $new->createNew(Input::get());
    }

    public function get_edit($id = NULL)
    {
        $news = News::find($id);
        if(empty($news))
        {
           return View::make('msg.error')
               ->with('error', 'News item doesn\'t exist.');
        }
        return View::make('page.admin.news.edit')
            ->with('news',  $news);
    }
    public function post_edit($id = NULL)
    {
        $news = News::find($id);
        if(empty($news))
        {
            return View::make('msg.error')
                ->with('error', 'News item doesn\'t exist.');
        }
        return $news->createNew(Input::get());
    }
    public function get_delete($id = NULL)
    {
        $news = News::find($id);
        if(empty($news))
        {
            return View::make('msg.error')
                ->with('error', 'That news item doesn\'t exist.');
        }
        return View::make('page.admin.news.delete')
            ->with('news', $news);
    }

    public function post_delete($id)
    {
        $news = News::find($id);
        if(empty($news))
        {
            return View::make('msg.error')
                ->with('error', 'That news item doesn\'t exist.');
        }
        $news->delete();
        return Redirect::to('/admin/news/overview');
    }

}
