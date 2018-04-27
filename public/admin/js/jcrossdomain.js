(function (win){
  var _jcd = {
    isInited : false,
    elmt : false,
    hash : '',
    delims : ',',
    rand : function(){
      return (new Date).getTime()
    },
    msg : function(){
      alert('Warning: You must call init function at first');
    },
    init : function(callback, elmt){
      if(_jcd.isInited == true)
        return;
      _jcd.isInited = true;
      _jcd.elmt = elmt;
      if(win.postMessage){
        //浏览器支持 HTML5 postMessage 方法
        if(win.addEventListener){
          //支持火狐、谷歌等浏览器
          win.addEventListener("message", function(ev){
            callback.call(win, ev.data);
          },false);
        }else if(win.attachEvent){
          //支持IE浏览器
          win.attachEvent("onmessage", function(ev){
            callback.call(win, ev.data);
          });
        }
        _jcd.msg = function(data){
          _jcd.elmt.postMessage(data, '*');
        }
      }else{
        //浏览器不支持 HTML5 postMessage 方法，如IE6、7
        setInterval(function(){
          if (win.name !== _jcd.hash) {
            _jcd.hash = win.name;
            callback.call(win, _jcd.hash.split(_jcd.delims)[1]);
          }
        }, 50);
        _jcd.msg = function(data){
          _jcd.elmt.name = _jcd.rand() + _jcd.delims + data;
        }
      }
    }
  };

  var jcd = {

    initParent : function(callback, iframeId){
      _jcd.init(callback, document.getElementById(iframeId).contentWindow);
    },

    initChild : function(callback){
      _jcd.init(callback, win.parent);
    },

    sendMessage : function(data){
      _jcd.msg(data);
    }

  };
  win.jCrossDomain = jcd;
})(window);