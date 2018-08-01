




/* locks */
//Lock constructor
const Lock = (cssTarget_p, scope_p, status_p = false, event_start_p, event_end_p) =>
  ({
    cssTarget: cssTarget_p,
    targetName: cssTarget_p.replace(/#|\./g, ''),
    scope: scope_p,
    status: status_p,
    event_start: event_start_p,
    event_end: event_end_p,
    pri: 0,
    enter(pri_p = 0, silent_mode = false) {
      if(this.status || (pri_p > this.pri)){
        this.status = false;
        this.pri = pri_p;
        if(!silent_mode){
          $('#event_emmiter').trigger(this.event_start);
        }
        return true;
      }else{
        return false;
      }
    },
    leave(pri_p = 0, silent_mode = false) {
      if(!this.status && (pri_p >= this.pri)){ // pri_p >= this.pri
        this.pri = 0;
        this.status = true;
        if(!silent_mode){
          $('#event_emmiter').trigger(this.event_end);
        }
      }
    },

    isOpen(){return this.status;},
    isClose(){return !this.status;},
    log(){
      console.log("cssTarget: "+this.cssTarget+"\ntargetName: "+this.targetName
      +"\nscope: "+this.scope+"\nstatus: "+this.status+"\nisOpen(): "+this.isOpen()
      +"\nisClose(): "+this.isClose());
    }
  });


/* Nav handler lock */
const nav_display_lock = Lock(".header_icon", "animation", true,
                              "nav_animation_start", "nav_animation_end");

/* Main scroll lock */
const scroll_lock = Lock("window", "scroll", true,
                          "main_scroll_start", "main_scroll_end");

const touch_scroll_lock = Lock("window", "touch_scroll", true,
                              "touch_scroll_start", "touch_scroll_end");

//leave all locks
const leave_locks = () => {
  scroll_lock.leave(9999, true);
  nav_display_lock.leave(9999, true);
}

//Global param object
//Constructor



/* scroll handler functions --------------------------------------------------*/
const keys = {37: 1, 38: 1, 39: 1, 40: 1};

const preventDefault = (e) => {
  e = e || window.event;
  if (e.preventDefault)
      e.preventDefault();
  e.returnValue = false;
}

const preventDefaultForScrollKeys = (e) => {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

const disableScroll = () => {
  if (window.addEventListener) // older FF
      window.addEventListener('DOMMouseScroll', preventDefault, false);
  window.addEventListener("wheel", preventDefault); // modern standard
  window.addEventListener("mousewheel", preventDefault); // older browsers, IE
  window.addEventListener("touchmove", preventDefault); // mobile
  document.onkeydown  = preventDefaultForScrollKeys;
  document.body.style.touchAction = "none";
}

const enableScroll = () => {
    if (window.removeEventListener)
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.removeEventListener("wheel", preventDefault);
    window.removeEventListener("mousewheel", preventDefault);
    window.removeEventListener("touchmove", preventDefault);
    document.onkeydown = null;
    document.body.style.touchAction = "auto";
}

const scroll_spy_handler = (e) => {
  console.log(e);
}

/*//Mobile touches
touch_start_scroll_handler = (e) => {
  global.touchStartY = e.touches[0].pageY;
  global.touchStartT = e.timeStamp;

}

touch_move_scroll_handler = (pageY) => {
  if(scroll_lock.isOpen()){
    let dist = global.currentY + global.touchStartY - pageY;
    if(dist < 0){
      dist = 0;
    }else if(dist > global.windowHeight*(global.nSections-1)){
      dist = global.windowHeight*(global.nSections-1);
    }
    if(touch_scroll_lock.enter()){
      animate_out_section_scroll_nav();
    }
    scroll_top(dist, 0, false);
  }

}

touch_end_scroll_handler = (e) => {
  let time = e.timeStamp - global.touchStartT;
  let dist = global.touchStartY - e.changedTouches[0].pageY;
  let v = dist / time;
  let jump = false;

  if(dist !== 0){
    global.currentYAdd(dist);
    console.log("time: "+ time + ", dist: "+dist+", v: "+v);
    if(Math.abs(v) >= 1.2 && global.currentY > 0 &&
    global.currentY < (global.get_sections(global.nSections-1))){

      global.currentYAdd(v*global.windowHeight/2);
      jump = true;
    }

    let section = Math.trunc(global.currentY/global.windowHeight);
    let breakpoint = 0.2*global.windowHeight;
    console.log(breakpoint);

    if(Math.abs(global.currentY - global.get_sections(section)) <= breakpoint){

      global.currentSection=section;
      section_scroll_to(section, 200);
      console.log("CURRRRRRRRENT");
      console.log((global.currentY - global.get_sections(section)));
    }else if(global.isNotCurrentSectionLast && (Math.abs(global.currentY - global.get_sections(section+1))
        <= breakpoint)){

      global.currentSection=section+1;
      section_scroll_to(section+1, 200);
      console.log("NEEEEEEEEEEEXT");
      console.log((global.currentY - global.get_sections(section+1)));
    }else if(jump){
      scroll_top(global.currentY, 1000);
      console.log("NORRRRRRRRRRMAL");
    }

    touch_scroll_lock.leave();
    animate_in_section_scroll_nav();
    global.log();
    global.currentYAdd(dist);
    global.touchStartY = 0;
    global.touchStartT = 0;
}
}*/

/* resize handler functions --------------------------------------------------*/


const reset_desktop_css = () => {
  $('.header_icon').hide();
  $('#nav_sub_container').show().css("opacity", "1");
  $('.nav_button').show().css("opacity", "1");
  $('#nav_layer').hide();
  $('.nav_container_divider').hide();
  $('#top_nav_container').show();
  enableScroll();
}

const reset_mobile_css = () => {
  $('#display_icon').show();
  $('#close_icon').hide();
  $('#nav_sub_container').hide();
  $('.nav_button').hide();
  $('#nav_layer').hide();
  $('.nav_container_divider').hide();
  //animate_in_section_scroll_nav(88, 0);
  $('#top_nav_container').show();

  if($('#display_icon').hasClass('flip_out_left')){
    $('#display_icon').toggleClass('flip_out_left');
  }

  if($('#clsoe_icon').hasClass('flip_out_right')){
    $('#close_icon').toggleClass('flip_out_right');
  }
}

const resize_mobile_handler = () => {
  if($(window).width() < 1024){
    console.log("mobile resizer");
    reset_mobile_css();
    leave_locks();
    $(window).off('resize', resize_mobile_handler);
    $(window).on('resize', resize_desktop_handler);
  }
}

const resize_desktop_handler = () => {
  if($(window).width() >= 1024){
    console.log("desktop resizer");
    reset_desktop_css();
    leave_locks();
    $(window).off('resize', resize_desktop_handler);
    $(window).on('resize', resize_mobile_handler);
  }
}

/* end resize handler functions ----------------------------------------------*/

/* mobile nav handler definitions--------------------------------------------------------*/

const display_mobile_nav = () => {
  if(nav_display_lock.enter()){
    disableScroll();


     //500 t

    $('#display_icon').toggleClass('flip_out_left');
    $('#display_icon').fadeOut(400, function(){
      $('#close_icon').fadeIn(200);
    });

    //600 t
    //$('#section_nav_container_down').slideUp(100, function(){
    $('#nav_sub_container').animate({width: 'toggle', opacity: 1}, 200, function(){
      $('#nav_layer').fadeIn(300);
      $('#nav_events_button').animate({width: 'toggle', opacity: 1},25,$.bez([.34,.15,.25,1]));
      $('#nav_sites_button').animate({width: 'toggle', opacity: 1},50,$.bez([.34,.15,.25,1]));
      $('#nav_divider1').animate({width: 'toggle', opacity: 1},100,$.bez([.34,.15,.25,1]));
      $('#nav_blog_button').animate({width: 'toggle', opacity: 1},125,$.bez([.34,.15,.25,1]));
      $('#nav_about_button').animate({width: 'toggle', opacity: 1},175,$.bez([.34,.15,.25,1]));
      $('#nav_divider2').animate({width: 'toggle', opacity: 1},225,$.bez([.34,.15,.25,1]));
      $('#nav_login_button').animate({width: 'toggle', opacity: 1},250,$.bez([.34,.15,.25,1]));
      $('#nav_signup_button').animate({width: 'toggle', opacity: 1},300,$.bez([.34,.15,.25,1]), function(){
        $('#display_icon').toggleClass('flip_out_left');
        window.setTimeout(function(){nav_display_lock.leave();}, 100);
      });
    });
    //});
  }
}


const close_mobile_nav = () =>{
  if(nav_display_lock.enter()){

    $('#nav_sub_container').children().each(function () {
      $(this).fadeOut(100);
    });
    $('#close_icon').toggleClass('flip_out_right');
    $('#nav_layer').fadeOut(200);
    $('#close_icon').fadeOut(200, function(){
      $('#display_icon').fadeIn(200);
    });

    $('#nav_sub_container').animate({
    width: 'toggle', opacity: 0}, 200,$.bez([.75,.15,1,.15]), function(){
      $('#close_icon').toggleClass('flip_out_right');
      //animate_in_section_scroll_nav(3); //Free scrolling & animation
      enableScroll();
      window.setTimeout(function(){nav_display_lock.leave();}, 100);
    });
  }
}

/* end mobile nav handler ----------------------------------------------------*/


/*parallax*/



/* ------------------- MAIN --------------------------------------------------*/


$(document).ready(function(){
  $(window).on('load', function(){
    if($(window).width() < 1024){
      reset_mobile_css();
      $(window).on('resize', resize_desktop_handler);
    }else{
      reset_desktop_css();
      $(window).on('resize', resize_mobile_handler);
    }



    // Mobile nav handler
    $('#display_icon').on('click', display_mobile_nav);
    $('#close_icon').on('click', close_mobile_nav);
    $('#nav_layer').on('click', close_mobile_nav);


    //Bot nav buttons
    //$('#next_section_icon').on('click', section_scroll_handler_next_button);
    //$('#prev_section_icon').on('click', section_scroll_handler_prev_button);

    /*//Wheel and touchpad
    addWheelListener( window, function( e ) {
      e.preventDefault();
      section_scroll_handler_wheel(e.deltaY);
    });*/

    //Scroll spy
    /*$('html, body').on("scroll", function(){
      parallax();
    });*/



    //Custom evenst debug
    $('#event_emmiter').on("nav_animation_start", function(){
      console.log("nav_start_animation");
    });
    $('#event_emmiter').on("nav_animation_end", function(){
      console.log("nav_end_animation");
    });

    $('#event_emmiter').on("main_scroll_start", function(){
      console.log("main_scroll_start");
    });
    $('#event_emmiter').on("main_scroll_end", function(){
      console.log("main_scroll_end");
    });


  });
});



$(document).ready(function(){
  // Attach resize handler and set responsive properties on web landing


  /*//Mobile
  window.addEventListener('touchmove',function(e){
    touch_move_scroll_handler(e.touches[0].pageY);
    //touch_pruebas(e);
  });
  window.addEventListener('touchstart',function(e){
    touch_start_scroll_handler(e);
    //touch_pruebas(e);
  });
  window.addEventListener('touchend',function(e){
    touch_end_scroll_handler(e);//.changedTouches[0].pageY);
    //touch_pruebas(e);
  });*/

});




/* ------------------- end-MAIN ----------------------------------------------*/











/* ------------------------- PLUGINS -----------------------------------------*/


/*!
 * Bez @VERSION
 * http://github.com/rdallasgray/bez
 *
 * A plugin to convert CSS3 cubic-bezier co-ordinates to jQuery-compatible easing functions
 *
 * With thanks to Nikolay Nemshilov for clarification on the cubic-bezier maths
 * See http://st-on-it.blogspot.com/2011/05/calculating-cubic-bezier-function.html
 *
 * Copyright @YEAR Robert Dallas Gray. All rights reserved.
 * Provided under the FreeBSD license: https://github.com/rdallasgray/bez/blob/master/LICENSE.txt
 */
(function(factory) {
  if (typeof exports === "object") {
    factory(require("jquery"));
  } else if (typeof define === "function" && define.amd) {
    define(["jquery"], factory);
  } else {
    factory(jQuery);
  }
}(function($) {
  $.extend({ bez: function(encodedFuncName, coOrdArray) {
    if ($.isArray(encodedFuncName)) {
      coOrdArray = encodedFuncName;
      encodedFuncName = 'bez_' + coOrdArray.join('_').replace(/\./g, 'p');
    }
    if (typeof $.easing[encodedFuncName] !== "function") {
      var polyBez = function(p1, p2) {
        var A = [null, null], B = [null, null], C = [null, null],
            bezCoOrd = function(t, ax) {
              C[ax] = 3 * p1[ax], B[ax] = 3 * (p2[ax] - p1[ax]) - C[ax], A[ax] = 1 - C[ax] - B[ax];
              return t * (C[ax] + t * (B[ax] + t * A[ax]));
            },
            xDeriv = function(t) {
              return C[0] + t * (2 * B[0] + 3 * A[0] * t);
            },
            xForT = function(t) {
              var x = t, i = 0, z;
              while (++i < 14) {
                z = bezCoOrd(x, 0) - t;
                if (Math.abs(z) < 1e-3) break;
                x -= z / xDeriv(x);
              }
              return x;
            };
        return function(t) {
          return bezCoOrd(xForT(t), 1);
        }
      };
      $.easing[encodedFuncName] = function(x, t, b, c, d) {
        return c * polyBez([coOrdArray[0], coOrdArray[1]], [coOrdArray[2], coOrdArray[3]])(t/d) + b;
      }
    }
    return encodedFuncName;
  }});
}));





/* src: https://developer.mozilla.org/en-US/docs/Web/Events/wheel
 * creates a global "addWheelListener" method
 */

(function(window,document) {

    var prefix = "", _addEventListener, support;

    // detect event model
    if ( window.addEventListener ) {
        _addEventListener = "addEventListener";
    } else {
        _addEventListener = "attachEvent";
        prefix = "on";
    }

    // detect available wheel event
    support = "onwheel" in document.createElement("div") ? "wheel" : // Modern browsers support "wheel"
              document.onmousewheel !== undefined ? "mousewheel" : // Webkit and IE support at least "mousewheel"
              "DOMMouseScroll"; // let's assume that remaining browsers are older Firefox

    window.addWheelListener = function( elem, callback, useCapture ) {
        _addWheelListener( elem, support, callback, useCapture );

        // handle MozMousePixelScroll in older Firefox
        if( support == "DOMMouseScroll" ) {
            _addWheelListener( elem, "MozMousePixelScroll", callback, useCapture );
        }
    };

    function _addWheelListener( elem, eventName, callback, useCapture ) {
        elem[ _addEventListener ]( prefix + eventName, support == "wheel" ? callback : function( originalEvent ) {
            !originalEvent && ( originalEvent = window.event );

            // create a normalized event object
            var event = {
                // keep a ref to the original event object
                originalEvent: originalEvent,
                target: originalEvent.target || originalEvent.srcElement,
                type: "wheel",
                deltaMode: originalEvent.type == "MozMousePixelScroll" ? 0 : 1,
                deltaX: 0,
                deltaY: 0,
                deltaZ: 0,
                preventDefault: function() {
                    originalEvent.preventDefault ?
                        originalEvent.preventDefault() :
                        originalEvent.returnValue = false;
                }
            };

            // calculate deltaY (and deltaX) according to the event
            if ( support == "mousewheel" ) {
                event.deltaY = - 1/40 * originalEvent.wheelDelta;
                // Webkit also support wheelDeltaX
                originalEvent.wheelDeltaX && ( event.deltaX = - 1/40 * originalEvent.wheelDeltaX );
            } else {
                event.deltaY = originalEvent.deltaY || originalEvent.detail;
            }

            // it's time to fire the callback
            return callback( event );

        }, useCapture || false );
    }

})(window,document);
