Event.observe(window, 'load', function() {
    $$('p.error').each(function(elem){
        elem.up().addClassName('error');
    });

    $$('p.pass').each(function(elem){
        elem.up().addClassName('pass');
    });

    $$('p.notapplicable').each(function(elem){
        elem.up().addClassName('notapplicable');
    });
});