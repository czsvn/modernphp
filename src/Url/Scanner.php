<?php
namespace Oreilly\ModernPHP\Url;

class Scanner
{
    /**
     * 
     * @var array 一个由URL组成的数组
     */
    protected $urls;
    
    /**
     * 
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;
    
    /**
     * 构造方法
     * @param array $urls
     */
    public function __construct(array $urls)
    {
        $this->urls = $urls;
        $this->httpClient = new \GuzzleHttp\Client();
    }
    
    /**
         *  获取无效链接
     * @return array
     */
    public function getInvalidUrls()
    {
        $invialidUrls = [];
        foreach ($this->urls as $url) {
            try {
                $statusCode = $this->getStatusCodeForUrl($url);
            } catch (\Exception $e) {
                $statusCode = 500;
            }
            
            if ($statusCode >= 400) {
                array_push($invialidUrls, [
                    'url' => $url,
                    'status' => $statusCode
                ]);
            }
        }
        
        return $invialidUrls;
    }
    
    /**
         *  获取指定URL的HTTP状态码
     * @param string $url $url远程URL
     * @return int HTTP状态码
     */
    protected function getStatusCodeForUrl($url)
    {
        $httpResponse = $this->httpClient->options($url);
        
        return $httpResponse->getStatusCode();
    }
}