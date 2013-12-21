<?php

class BizimLogger {
    public function log($msg) {
        echo "3 saniye beklemeden direkt yazdim :" . $msg;
    }
}

class LoginTest extends TestCase {

    /**
     * @test
     */
	public function girisSayfasinda200AliyorMuyum()
	{
		$crawler = $this->client->request('GET', '/giris');
		$this->assertTrue($this->client->getResponse()->isOk());
	}


    /**
     * @test
     */
	public function girisSayfasindaFormGoruyorMuyum()
    {
        $crawler = $this->client->request('GET', '/giris');
        $this->assertCount(1, $crawler->filter('form'));
	}

    /**
     * @test
     */
	public function girisSayfasindaTextInputVarMi()
    {
        $crawler = $this->client->request('GET', '/giris');
        $this->assertCount(1, $crawler->filter('form input[type=text][name=username]'));
	}

    /**
     * @test
     */
	public function girisSayfasindaSubmitButtonVarMi()
    {
        $crawler = $this->client->request('GET', '/giris');
        $this->assertCount(1, $crawler->filter('form input[type=submit]'));
	}

   /**
     * @test
     */
	public function formunMethoduPostMu()
    {
        $crawler = $this->client->request('GET', '/giris');
        $this->assertCount(1, $crawler->filter('form[method=post]'));
	}

   /**
     * @test
     */
	public function postEdince200DonuyorMu()
    {
        $crawler = $this->client->request('POST', '/giris');
		$this->assertTrue($this->client->getResponse()->isOk());
	}
    
    public function setUp() {
        parent::setUp();

        $mock = Mockery::mock('BizimLogger');
        $mock->shouldReceive('log');
        App::instance("file.logger", $mock); 
    }


    public function tearDown() {
        parent::tearDown();
        echo "test bitti \n";
    }


   /**
     * @test
     */
	public function isimPhptrIseHibritYaziyorMu()
    {

        $response = $this->call('POST', '/giris', array("username" => "phptr"));

        $this->assertRegExp('/Hibrit/', $response->getContent());
	}


   /**
     * @test
     */
	public function girisYapanKullanicininAdiGeliyorMu()
    {
        $response = $this->call('POST', '/giris', array("username" => "hodo"));

        $this->assertRegExp('/Giris yapan kullanici: hodo/', $response->getContent());
	}


   /**
     * @test
     */
	public function phpTrGelinceLoglandiMi()
    {
        $response = $this->call('POST', '/giris', array("username" => "phptr"));
	}





}
