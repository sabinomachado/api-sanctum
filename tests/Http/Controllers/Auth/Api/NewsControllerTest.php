<?php

namespace Tests\Http\Controllers\Auth\Api;

use App\Http\Controllers\Auth\Api\NewsController;
use App\Repositories\NewsRepository;
use PHPUnit\Framework\TestCase;

class NewsControllerTest extends TestCase
{

    public function testIndex()
    {
        $newsRepository = $this->createMock(NewsRepository::class);
        $newsController = new NewsController($newsRepository);
        $news = $newsController->index();
        $this->assertInstanceOf('Illuminate\Http\Resources\Json\ResourceCollection', $news);
    }

}
