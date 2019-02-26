<?php
namespace App\Repositories\Contracts;

interface PostInterface extends Repositoryinterface
{
    public function getLatest();

    public function getSlide();
    
    public function getPopular();
    
}