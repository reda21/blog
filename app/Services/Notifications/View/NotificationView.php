<?php


namespace App\Services\Notifications\View;


use cebe\markdown\GithubMarkdown;

class NotificationView
{
    protected $notification;


    protected $attributs;

    protected $model;
    /**
     * @var GithubMarkdown
     */
    private $markdown;

    public function __construct($notification, $model)
    {
        $this->notification = $notification;

        $this->model = $model;
        $this->markdown = app(GithubMarkdown::class);
    }

    public function render()
    {
        $data = sprintf($this->message(), ...$this->getAttributs());
        $data = $this->markdown->parse($data);
        $data = preg_replace("/\\n/",'', $data);
        $data = preg_replace("/<p>/", "", $data);
        $data = preg_replace("|</p>$|", "", $data);
        return $data;
    }

    public function message()
    {
        return "default texte";
    }

    public function getAttributs()
    {
        return [
            $this->model->username,
        ];
    }
}
