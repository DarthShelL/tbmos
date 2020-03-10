/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/screen.js":
/*!********************************!*\
  !*** ./resources/js/screen.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var DSScreen = /*#__PURE__*/function () {
  function DSScreen() {
    _classCallCheck(this, DSScreen);

    this.moving = false;
    this.touchStartY = null; // stasis body

    document.body.style.overflow = 'hidden';
    document.body.style.height = '100vh'; // wrapper

    this.screenWrapper = document.querySelector('.screen-wrapper');
    this.screenWrapper.style.transition = 'margin-top .5s ease-in-out'; // find all screen sections

    this.currentScreen = 1;
    this.screens = document.querySelectorAll('section.screen'); // scroll controll

    document.addEventListener("wheel", this.wheelHandler.bind(this), {
      passive: false
    });
    document.addEventListener("touchstart", this.touchStartHandler.bind(this), {
      passive: false
    });
    document.addEventListener("touchmove", this.touchMoveHandler.bind(this), {
      passive: false
    });
    document.addEventListener("touchend", this.touchEndHandler.bind(this), {
      passive: false
    });
    this.updateScreen();
  }

  _createClass(DSScreen, [{
    key: "touchStartHandler",
    value: function touchStartHandler(e) {
      if (e.target.classList.contains('navbar-toggler-icon')) return;
      if (e.target.classList.contains('button')) return;
      if (e.target.classList.contains('slider-arrow-left')) return;
      if (e.target.classList.contains('slider-arrow-right')) return;
      e.preventDefault();
      this.touchStartY = e.changedTouches[0].screenY;
    }
  }, {
    key: "touchMoveHandler",
    value: function touchMoveHandler(e) {
      e.preventDefault();
      if (!this.touchStartY) return;
      var currentTouchY = e.changedTouches[0].screenY;

      if (currentTouchY > this.touchStartY) {
        this.swipeDirection = -1;
      } else {
        this.swipeDirection = 1;
      }
    }
  }, {
    key: "touchEndHandler",
    value: function touchEndHandler(e) {
      if (e.target.classList.contains('navbar-toggler-icon')) return;
      if (e.target.classList.contains('button')) return;
      if (e.target.classList.contains('slider-arrow-left')) return;
      if (e.target.classList.contains('slider-arrow-right')) return;
      e.preventDefault();
      if (!this.swipeDirection) return;

      if (this.swipeDirection > 0) {
        this.nextScreen();
      } else {
        this.prevScreen();
      }

      this.touchStartY = null;
      this.swipeDirection = null;
    }
  }, {
    key: "wheelHandler",
    value: function wheelHandler(e) {
      e.preventDefault();
      if (this.moving) return;

      if (e.deltaY > 0) {
        this.nextScreen();
      } else {
        this.prevScreen();
      }
    }
  }, {
    key: "nextScreen",
    value: function nextScreen() {
      var maxScreens = this.screens.length;

      if (this.currentScreen < maxScreens) {
        this.currentScreen++;
        this.updateScreen();
      }
    }
  }, {
    key: "prevScreen",
    value: function prevScreen() {
      var maxScreens = this.screens.length;

      if (this.currentScreen > 1) {
        this.currentScreen--;
        this.updateScreen();
      }
    }
  }, {
    key: "goto",
    value: function goto(screen) {
      this.currentScreen = screen;
      this.updateScreen();
    }
  }, {
    key: "updateScreen",
    value: function updateScreen() {
      if (this.moving) return;
      this.moving = true;
      setTimeout(function () {
        this.moving = false;
      }.bind(this), 500);
      var marginTop = (this.currentScreen - 1) * -100;
      this.screenWrapper.style.marginTop = marginTop + 'vh';
    }
  }]);

  return DSScreen;
}();

document.addEventListener("DOMContentLoaded", function () {
  window.DSSC = new DSScreen();
});

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/screen.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/tbmos/resources/js/screen.js */"./resources/js/screen.js");


/***/ })

/******/ });