<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use NumberFormatter;

/**
 * Formatter helper.
 */
class Formatter
{
    /**
     * Locale used to format the numbers.
     *
     * @var string
     * @access protected
     */
    protected $locale;

    /**
     * Decimal number formatter.
     *
     * @var NumberFormatter
     * @access protected
     */
    protected $decimal;

    /**
     * Currency number formatter.
     *
     * @var NumberFormatter
     * @access protected
     */
    protected $currency;

    /**
     * Create a new Formatter helper instance.
     *
     * @access public
     * @param string $locale Locale used to format the numbers.
     */
    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * Format a number using the decimal formatter.
     *
     * @access public
     * @param int|float $number
     * @param int|null  $digits
     * @return string
     */
    public function decimal($number, ?int $digits = null): string
    {
        $formatter = $this->getDecimalFormatter();

        if (!is_null($digits)) {
            $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $digits);
        }

        return $formatter->format($number);
    }

    /**
     * Format a number using the currency formatter.
     *
     * @access public
     * @param int|float $number
     * @param string    $currency The 3-letter ISO 4217 currency code indicating the currency to use.
     * @return string
     */
    public function currency($number, string $currency = 'EUR'): string
    {
        $formatter = $this->getCurrencyFormatter();

        return $formatter->formatCurrency($number, $currency);
    }

    /**
     * Retrieve (and initialize if necessary) the decimal number formatter.
     *
     * @access protected
     * @return NumberFormatter
     */
    protected function getDecimalFormatter(): NumberFormatter
    {
        if (is_null($this->decimal)) {
            $this->decimal = new NumberFormatter($this->locale, NumberFormatter::DECIMAL);
        }

        return $this->decimal;
    }

    /**
     * Retrieve (and initialize if necessary) the currency number formatter.
     *
     * @access protected
     * @return NumberFormatter
     */
    protected function getCurrencyFormatter(): NumberFormatter
    {
        if (is_null($this->currency)) {
            $this->currency = new NumberFormatter($this->locale, NumberFormatter::CURRENCY);
        }

        return $this->currency;
    }

    /**
     * Format a date.
     *
     * @access public
     * @param int|null $year
     * @param int|null $month
     * @param int|null $day
     * @return string
     */
    public static function date(?int $year = null, ?int $month = null, ?int $day = null): string
    {
        $date = Carbon::createFromDate($year, $month, $day)->formatLocalized(trans('dates.formats.human.without_time'));

        return self::apostrophe($date);
    }

    /**
     * Format a date and time.
     *
     * @access public
     * @param int|null $year
     * @param int|null $month
     * @param int|null $day
     * @param int|null $hour
     * @param int|null $minute
     * @param int|null $second
     * @return string
     */
    public static function datetime(
        ?int $year = null,
        ?int $month = null,
        ?int $day = null,
        ?int $hour = null,
        ?int $minute = null,
        ?int $second = null
    ): string {
        $date = Carbon::create($year, $month, $day, $hour, $minute,
            $second)->formatLocalized(trans('dates.formats.human.with_time'));

        return self::apostrophe($date);
    }

    /**
     * Adds apostrophes if necessary.
     *
     * @static
     * @access protected
     * @param string $string
     * @return string
     */
    protected static function apostrophe(string $string): string
    {
        if (App::getLocale() === 'ca') {
            $string = preg_replace('/de ([aeiou])/', 'd\'$1', $string);
        }

        return $string;
    }
}
