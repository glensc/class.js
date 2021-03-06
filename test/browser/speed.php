<!doctype html>
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="benchmark/jquery-benchmark-suit.css" />
    <script src="jquery.js"></script>
    <script src="benchmark/jquery-benchmark.js"></script>
    <script src="benchmark/jquery-benchmark-suit.js"></script>
    <script src="../../jquery.class<?php echo isset($_GET["a"]) ? $_GET["a"] : "" ?>.js"></script>
    <script>

plugin("jQuery.Class");

module("Build");

test("Building 20.000 basic classes", 10000, function(t){
    var a,b;
    while(t--) {
        a = $.Class({

            init: function(){},
            fn: function(){},
            ds: function(){},
            fds: function(){},
            fds: function(){}

        });

        b = a.extend({
            init: function(){this._parent();},
            fds: function(){},
            asd: function(){},
            vcx: function(){},
            few: function(){},
            dqw: function(){}
        });
    }
});

test("Building 20.000 static classes", 10000, function(t){
    var a,b;
    while(t--) {
        a = $.Class({

            staticFn: function(){},

            prototype: {
                init: function(){}
            }

        });

        b = a.extend({

            staticFn: function(){this._parent();},

            prototype: {
                init: function(){this._parent();}
            }

        });
    }
});

var fns = {};
var times = 50;
while(times--)
    fns["fn"+times] = function(){};

test("Extending an instance", 10000, function(t){
    
    var instance = new ($.Class({
            
        init: function(){

        }
        
    }));
    
    while(t--) {
        instance.addMethods({
            
            init: function(){
                this._parent();
            }
            
        });
    }
    
});

module("Initalizing");

test("Initalizing an object with the new keyword with a constructor", 100000, function(t){
    var b, a = $.Class({
        init: function(){}
    });
    while(t--) {
        b = new a();
    }
});

test("Initalizing an object without using the new keyword with a constructor", 100000, function(t){
    var b, a = $.Class({
        init: function(){}
    });
    while(t--) {
        b = a();
    }

});

test("Initalizing an object with the new keyword without a constructor", 100000, function(t){
    var b, a = $.Class({});
    while(t--) {
        b = new a();
    }
});

test("Initalizing an object without using the new keyword without a constructor", 100000, function(t){
    var b, a = $.Class({});
    while(t--) {
        b = a();
    }

});

test("Initalizing an object with the new keyword, reference", 100000, function(t){
    function A(){}
    while(t--) {
        new A();
    }
});

module("Calling");

(function(){

var A = $.Class({
    fn: function () {}
});

var B = A.extend({
    fn: function () {
        this._parent();
    },
    fn2: function(){
        this._parent.fn();
    }
});

var b = new B();

test("_parent function call", 100000, function (t) {
    while(t--)
        b.fn();
});

test("_parent.fn function call", 100000, function (t) {
    while(t--)
        b.fn2();
});

}());

(function(){

var A = function(){};
A.prototype.fn = function(){};

var B = function(){};
B.prototype.fn = function(){
    A.prototype.fn.apply(this, arguments);
};

var b = new B();

test("_parent function call, reference", 100000, function (t) {
    while(t--)
        b.fn();
});

}());
    </script>
  </head>
  <body>
  </body>
</html>
