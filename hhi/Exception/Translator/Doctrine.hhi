<?hh // strict

namespace Caridea\Dao\Exception\Translator;

class Doctrine
{
    public static function translate(\Exception $e): \Exception
    {
        return new \Exception();
    }
}
