<?hh // strict

namespace Caridea\Dao\Exception\Translator;

class MongoDb
{
    public static function translate(\Exception $e): \Exception
    {
        return new \Exception();
    }
}
