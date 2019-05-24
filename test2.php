<?php
/**
 * 性状 trait
 */
trait Geocodable {
    /** @var string 地址（字符串）*/
    protected $address;

    /** @var \Geocoder\Geocoder 地理编码器对象 http://geocoder-php.org willdurand/geocoder组件*/
    protected $geocoder;

    /** @var \Geocoder\Result\Geocoded 地理编码器处理后得到的结果对象*/
    protected $geocoderResult;

    public function setGeocoder(\Geocoder\GeocoderInterface $geocoder)
    {
        $this->geocoder = $geocoder;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getLatitude() 
    {
        if (isset($this->geocoderResult) === false) {
            $this->geocodeAddress();
        }

        return $this->geocoderResult->getLatitude();
    }

    public function getLongitude()
    {
        if (isset($this->geocoderResult) === false) {
            $this->geocodeAddress();
        }

        return $this->geocoderResult->getLongitude();
    }

    protected function getcodeAddress()
    {
        $this->geocoderResult = $this->geocoder->geocode($this->address);

        return true;
    }
}


class RetailStore
{
    use Geocodeable;
}


//
$geocoderAdaper = new \Geocoder\HttpAdapter\CurlHttpAdapter();
$geocoderProvider = new \Geocoder\Provider\GoogleMapsProvider($geocoderAdaper);
$geocoder = new \Geocoder\Geocoder($geocoderProvider);

$store = new RetailStore();
$store->setAddress('420 9th Avenue, New York, NY 10001 USA');
$sotre->setGeocoder($geocoder);

$latitude = $store->getLatitude();
$longitude = $store->getLongitude();
echo $latitude, ":", $longitude;