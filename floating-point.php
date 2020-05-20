<?php


class FloatingPoint
{
    public function main()
    {
        $this->example1();
//        $this->example2();
//        $this->example3();
    }

    /**
     * Difference is a small fraction
     */
    private function example1()
    {
        $display_price = 50.39;
        $shipping_price = 35.12;
        $asking_price = 15.27;

        $actual_seller_discount = $asking_price - ($display_price - $shipping_price);
        $expected_seller_discount = 0.00;

        if ($actual_seller_discount === $expected_seller_discount) {
            $this->print_ra('Do something really important');
        } else {
            $this->print_ra('Houston, we have a problem...');
            var_dump($actual_seller_discount);
            var_dump($expected_seller_discount);
        }

        /**
         * SPOILER ALERT
         * $actual_seller_discount = bcadd($asking_price, -(bcadd($display_price, -$shipping_price, 2)), 2);
         */
    }

    /**
     * Difference is hidden
     *
     * See: https://github.com/RecycledMedia/tradesy-common/blob/c7e1f2209e9d1b83b3d666335cea6132d75fc81a/src/Tradesy/Purchase/Checkout.php#L871
     */
    private function example2()
    {
        $asking_price = 8;
        $discount = 6.4;

        $actual_display_price = $asking_price - $discount;
        $expected_display_price = 1.6;

        if ($actual_display_price === $expected_display_price) {
            $this->print_ra('Do something really important');
        } else {
            $this->print_ra('Houston, we have a problem...');
            var_dump($actual_display_price);
            var_dump($expected_display_price);
        }

        /**
         * SPOILER ALERT
         * ini_set("precision", 18);
         */
    }

    /**
     * Same value is stored - 'precision' setting is just a more restrictive number formatter.
     */
    private function example3()
    {
        $i = 8-6.4;
        var_dump($i);
        ini_set('precision', 17);
        var_dump($i);
        ini_set('precision', 24);
        var_dump($i);
    }

    /**
     * Pretty print
     *
     * @param $val
     */
    private function print_ra($val)
    {
        print '<pre>';
        print_r($val);
        print '</pre>';
    }
}

(new FloatingPoint())->main();
