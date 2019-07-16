<?php
class A {
    public static function who() {
        echo "Ez az A osztaly";

    }

}

class B extends A {
    public static function who() {
        echo "Ez a B osztaly";
    }
    public static function test() {
        static::who(); // Here comes Late Static Bindings
    }
}
class C extends B {
    public static function who() {
        echo "Ez a C osztaly";
    }
}

C::test();
?>