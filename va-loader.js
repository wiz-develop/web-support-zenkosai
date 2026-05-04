'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function configurator(w, i, n, e) {
  // 初期化
  function configureVa(config) {
    var util = new Util(config);

    // 明示的に無効が設定されていたらここまで
    if (config.isEnabled === false) return;

    if (VA.jq('#va').length == 0) {
      return;
    }

    var vaArgs = {
      config: config,
      variables: {
        // スタート時の挨拶時間帯出し分け
        greeting: util.getGreeting()
      },
      handlers: {},
      attributesToAdd: {},
      functionsForRpc: {}
    };

    var specificUrl = new SpecificUrl();
    if (config.initType === 'PC') {
      var isContactPage = specificUrl.isSpecificUrl(['https://www.zenko-sai.or.jp/contact/', 'https://stg.zenko-sai.or.jp/contact/', 'http://app.va-site.net/nihonkyosai/va.html', 'http://app.va-site.net/nihonkyosai/va-confirmation.html']);
      config.uiThemeName = isContactPage ? 'embed' : 'toast';
      if (config.uiThemeName === 'toast') {
        config.initialPageName = 'launcher';
      }
    } else if (config.initType === 'SP') {
      // 旧VA起動ページは下部固定を除外
      var isLatestExclusion = specificUrl.isSpecificUrl(['https://www.zenko-sai.or.jp/guide/va/']);
      if (!isLatestExclusion) {
        config.footerHeight = 59;
        config.isInputFixedBottom = true;
        config.initialPageName = 'launcher';

        VA.jq('#js_header_menu > a').on('click', function () {
          VA.jq('#va-launcher').css('z-index', '-2');
        });

        VA.jq('#js_headerMenu_background,#js_headerMenu .js_headerMenu_close').on('click', function (e) {
          VA.jq('#va-launcher').css('z-index', '');
        });
      }
    }

    var showVA = function showVA() {
      return VA.getInstance(vaArgs).then(function () {
        if (!VA.instance.isStarted()) {
          VA.instance.start();

          if (config.initType === 'PC' && config.uiThemeName === 'toast') {
            // VA枠をドラッグ＆ドロップできるように設定する
            var targetElement = document.getElementById("va-window");
            var triggerElement = document.getElementById("va-header");
            util.setFloating(targetElement, triggerElement);
          } else if (config.initType === 'SP') {
            // VAが一度でも起動したら起動バナーを小バナーに変更する
            VA.jq('#va-launcher').addClass('bottom-slide-scale-down-fixed');
          }

          // 拡大アイコンを付ける関係上、handlersに記述する形式での処理が出来なかったので、jQueryイベントで処理
          VA.jq(document).on('click', "[name='va-zoomable']", function () {
            var zoomImg = VA.jq(this).find('img')[0];
            var zoomSrc = VA.jq(zoomImg).attr('src') || '';
            VA.BigPicture({
              el: zoomImg,
              imgSrc: zoomSrc
            });
          });
        }
      });
    };

    var UI = util.getUIClass(VA.redom);
    var ui = new UI({ showVA: showVA });

    // 外部バナーからVA開始できるようハンドラ設定
    VA.show = function () {
      ui.go('chatUi');
    };

    ui.mount(config.parentSelector, config.initialPageName);
  }

  var Util = function () {
    /**
     * コンストラクタ
     * @param config
     */
    function Util(config) {
      _classCallCheck(this, Util);

      this.config = config;
    }

    /**
     * UIクラスを返す
     * @param {object} redom
     * @returns {UI}
     */


    _createClass(Util, [{
      key: 'getUIClass',
      value: function getUIClass(redom) {
        var el = redom.el,
            _mount = redom.mount,
            setStyle = redom.setStyle;

        var config = this.config;
        var specificUrl = new SpecificUrl();

        /**
         * 起動バナー
         */

        var Launcher = function () {
          function Launcher(props) {
            var _this = this;

            _classCallCheck(this, Launcher);

            this.props = props;
            this.state = {
              display: false
            };
            this.el = el("div#va-launcher", {
              style: { display: this.state.display } }, this.closeButton = el('div#va-btn-close'));
            this.el.onclick = function (e) {
              _this.props.go("chatUi");
            };
            this.closeButton.onclick = function (e) {
              e.stopPropagation();
              _this.el.className = "va-launcher-active bottom-slide-scale-down";
              // アニメーションが何度も呼ばれてしまうので0.4s後に固定クラスに差し替え
              // アニメーションは0.8sですが終了のタイミングとクラス差し替えでデバイスによってはラグが発生し一瞬大バナーが表示されるので0.1s早く差し替える
              w.VA.launcherObjectForBounceControl = _this.el;
              setTimeout(function () {
                w.VA.launcherObjectForBounceControl.className = "va-launcher-active bottom-slide-scale-down-fixed";
              }, 700);
            };
          }

          _createClass(Launcher, [{
            key: 'update',
            value: function update(uiState) {
              this.state.display = uiState.pageName === "launcher";

              var isGuidePage = specificUrl.isSpecificUrl(['https://www.zenko-sai.or.jp/guide/', 'https://stg.zenko-sai.or.jp/guide/']);
              if (this.state.display && isGuidePage && config.initType === 'SP') {
                this.state.display = false;
              }

              var classNames = [];
              classNames.push(this.state.display ? "va-launcher-active" : "va-launcher-inactive");

              // ミニバナークラスの付与を確認
              var bottomSlideScaleDownClass = 'bottom-slide-scale-down-fixed';
              if (VA.jq('#va-launcher').hasClass(bottomSlideScaleDownClass)) {
                classNames.push(bottomSlideScaleDownClass);
              }

              this.el.className = classNames.join(" ");
            }
          }]);

          return Launcher;
        }();

        /**
         * PC用チャットUI
         */


        var ChatUiPc = function () {
          function ChatUiPc(props) {
            var _this2 = this;

            _classCallCheck(this, ChatUiPc);

            this.props = props;
            this.state = {
              displayedOnce: false // 一度でも表示したらtrue
            };
            this.el = el("div#va-window", { style: { display: "none" } }, [this.header = el("div#va-header", this.closeButton = el("span#va-header-closeButton")), this.va = el("div#va-root")]);
            this.closeButton.onclick = function (e) {
              _this2.props.go("launcher");
            };
          }

          _createClass(ChatUiPc, [{
            key: 'update',
            value: function update(uiState) {
              var _this3 = this;

              var isMyTurn = uiState.pageName === "chatUi";
              var showVaPromise = isMyTurn ? this.props.showVA() : Promise.resolve();
              showVaPromise.then(function () {
                if (isMyTurn) _this3.state.displayedOnce = true;
                if (_this3.state.displayedOnce) {
                  // 表示済みならactive/inactiveをつける。※まだ表示したことがなければクラスはつけない。
                  _this3.el.classList.add(isMyTurn ? "va-window-active" : "va-window-inactive");
                }
                _this3.el.style.display = isMyTurn ? "block" : "none";
              });
            }
          }]);

          return ChatUiPc;
        }();

        /**
         * SP用チャットUI
         */


        var ChatUiSp = function () {
          function ChatUiSp(props) {
            var _this4 = this;

            _classCallCheck(this, ChatUiSp);

            this.props = props;
            this.state = {
              display: false
            };
            // 旧VA起動ページは下部固定を除外
            var isLatestExclusion = specificUrl.isSpecificUrl(['https://www.zenko-sai.or.jp/guide/va/']);
            if (!isLatestExclusion) {
              this.el = el("div#va-window", { style: { display: this.state.display } }, this.pageHeader = el("div#va-page-header"), this.header = el("div#va-header", this.closeButton = el("span#va-header-backButton", "< 閉じる"), this.title = el("span#va-header-title", "おしえてライノくん")), this.va = el("div#va-root"));
              this.closeButton.onclick = function (e) {
                _this4.props.go("launcher");
              };
            } else {
              this.el = el("div#va-window", { style: { display: this.state.display } }, this.pageHeader = el("div#va-page-header"), this.header = el("div#va-header", this.backButton = el("span#va-header-backButton", "< 戻る", {
                style: { display: "none" }
              }), this.title = el("span#va-header-title", "おしえてライノくん")), this.va = el("div#va-root"));
              this.backButton.onclick = function (e) {
                history.back();
              };
              // 履歴がなければ戻るボタンを消す
              var hasHistory = window.history.length > 1;
              setStyle(this.backButton, { display: hasHistory ? "block" : "none" });
            }
          }

          _createClass(ChatUiSp, [{
            key: 'update',
            value: function update(uiState) {
              this.state.display = uiState.pageName === "chatUi";
              setStyle(this.el, { display: this.state.display ? "block" : "none" });
              if (this.state.display) {
                VA.jq("body").addClass("va-container-opened"); // iOS11バグ対策
                this.props.showVA();
              } else {
                VA.jq("body").removeClass("va-container-opened"); // iOS11バグ対策
              }
            }
          }]);

          return ChatUiSp;
        }();

        /**
         * UIクラス
         */


        var UI = function () {
          function UI(props) {
            _classCallCheck(this, UI);

            this.props = props;
            this.state = {
              pageName: "launcher"
            };
            var chatUiClass = config.initType === "PC" ? ChatUiPc : ChatUiSp;
            var showVA = this.props.showVA;
            var go = this.go.bind(this);
            var className = config.uiThemeName ? '.va-theme-' + config.uiThemeName : "";
            this.el = el('#va-container' + className, this.chatUi = new chatUiClass({ showVA: showVA, go: go }), this.launcher = new Launcher({ go: go }));
          }

          _createClass(UI, [{
            key: 'mount',
            value: function mount(selector, pageName) {
              var parent = document.querySelector(selector);
              _mount(parent, this.el);
              this.go(pageName || this.state.pageName);
            }
          }, {
            key: 'go',
            value: function go(pageName) {
              this.state.pageName = pageName;
              this.chatUi.update(this.state);
              this.launcher.update(this.state);
            }
          }]);

          return UI;
        }();

        return UI;
      }

      /**
       * スタート時の挨拶時間帯出し分け
       * @returns {string}
       */

    }, {
      key: 'getGreeting',
      value: function getGreeting() {
        var _config$greeting = this.config.greeting,
            morning = _config$greeting.morning,
            daytime = _config$greeting.daytime,
            night = _config$greeting.night;

        var hours = new Date().getHours();
        if (hours >= morning.startHour && hours < daytime.startHour) return morning.message;
        if (hours >= daytime.startHour && hours < night.startHour) return daytime.message;
        return night.message;
      }

      /**
       * フローティングの設定を行います
       * @param {element} targetElemet フローティング対象の要素
       * @param {element} triggerElemet ドラッグ対象の要素
       */

    }, {
      key: 'setFloating',
      value: function setFloating(targetElemet, triggerElement) {

        // 要素内のクリックされた位置を取得するグローバル（のような）変数
        var x = void 0;
        var y = void 0;
        var startTop = void 0;
        var startLeft = void 0;

        // VA枠がウィンドウの外に出た場合に戻ってきた際の余白
        var vaWindowMargin = 10;

        // マウスが押された際の関数
        var dragStart = function dragStart(e) {
          // tipsを非表示にする
          w.VA.jq('.tip').hide();

          // クラス名に .drag を追加
          targetElemet.classList.add("drag");

          // タッチデイベントとマウスのイベントの差異を吸収
          var event = e.type === "mousedown" ? e : e.changedTouches[0];

          // 要素内の相対座標を取得
          x = event.pageX - targetElemet.offsetLeft;
          y = event.pageY - targetElemet.offsetTop;

          // 開始位置を保持
          startTop = w.VA.jq(targetElemet).offset().top;
          startLeft = w.VA.jq(targetElemet).offset().left;

          // ムーブイベントにコールバック
          document.body.addEventListener("mousemove", drag, false);
          document.body.addEventListener("touchmove", drag, false);

          // マウスボタンが離されたとき、またはカーソルが外れたとき後処理を実行
          targetElemet.addEventListener("mouseup", dragEnd, false);
          document.body.addEventListener("mouseleave", dragEnd, false);
          targetElemet.addEventListener("touchend", dragEnd, false);
          document.body.addEventListener("touchleave", dragEnd, false);
        };

        // マウスカーソルが動いたときに発火
        var drag = function drag(e) {
          // 同様にマウスとタッチの差異を吸収
          var event = e.type === "mousemove" ? e : e.changedTouches[0];

          // フリックしたときに画面を動かさないようにデフォルト動作を抑制
          e.preventDefault();

          // マウスが動いた場所に要素を動かす
          targetElemet.style.top = event.pageY - y + 'px';
          targetElemet.style.left = event.pageX - x + 'px';
        };

        // マウスボタンが上がったら発火
        var dragEnd = function dragEnd(e) {

          // ウィンドウ外に移動した場合は、ウィンドウ内に戻す
          var top = parseInt(targetElemet.style.top.replace(/px/, ''));
          var left = parseInt(targetElemet.style.left.replace(/px/, ''));
          // 上が出た
          if (top < 0) targetElemet.style.top = vaWindowMargin + 'px';

          // 下が出た(戻ったあとにVAがウィンドウ内に収まる時だけ戻す)
          if (targetElemet.clientHeight + vaWindowMargin < window.innerHeight && top + targetElemet.clientHeight > window.innerHeight) {
            targetElemet.style.top = window.innerHeight - targetElemet.clientHeight - vaWindowMargin + 'px';
          }

          // 左が出た
          if (left < 0) targetElemet.style.left = vaWindowMargin + 'px';

          // 右が出た
          if (left + targetElemet.clientWidth > window.innerWidth) {
            targetElemet.style.left = window.innerWidth - targetElemet.clientWidth - vaWindowMargin + 'px';
          }

          // ムーブベントハンドラの消去
          document.body.removeEventListener("mousemove", drag, false);
          targetElemet.removeEventListener("mouseup", dragEnd, false);
          document.body.removeEventListener("mouseleave", dragEnd, false);

          document.body.removeEventListener("touchmove", drag, false);
          targetElemet.removeEventListener("touchend", dragEnd, false);
          document.body.removeEventListener("touchleave", dragEnd, false);

          // クラス名 .drag も消す
          targetElemet.classList.remove("drag");

          // tipsを移動させ再表示
          var moveDistanceTop = startTop - w.VA.jq(targetElemet).offset().top;
          var moveDistanceLeft = startLeft - w.VA.jq(targetElemet).offset().left;

          w.VA.jq('.tip').each(function (index, element) {
            var tip = w.VA.jq(element);
            var top = parseInt(tip[0].style.top.replace(/px/, ''));
            var left = parseInt(tip[0].style.left.replace(/px/, ''));
            tip[0].style.top = top - moveDistanceTop + 'px';
            tip[0].style.left = left - moveDistanceLeft + 'px';
          });
          w.VA.jq('.tip').show();
        };

        // マウスが要素内で押されたとき、又はタッチされたとき発火
        triggerElement.addEventListener("mousedown", dragStart, false);
        triggerElement.addEventListener("touchstart", dragStart, false);
      }
    }]);

    return Util;
  }();

  var SpecificUrl = function () {
    function SpecificUrl() {
      _classCallCheck(this, SpecificUrl);
    }

    _createClass(SpecificUrl, [{
      key: 'isSpecificUrl',

      /**
       * 自信のいるURLが特定のURLと合致する場合trueを返す
       * @returns {bool}
       */
      value: function isSpecificUrl(patterns) {
        var currentUrl = VA.URI(w.location.href).search(true)['va-location'] || w.location.href;
        return patterns.some(function (pattern) {
          var matcher = new VA.UrlMatch(pattern);
          return matcher.test(currentUrl);
        });
      }
    }]);

    return SpecificUrl;
  }();

  // globalへエクスポート


  w[i] = w[i] || {};
  w[i][n] = configureVa;
})(window, "VirtualAgentObject", "configureVa", "getInitType");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

(function initializer(w, i, n, e, s) {
  // VAMから与えられた設定
  var envGiven = {
    apiServerUrl: 'https://v1.va-api.net',
    staticServerUrl: 'https://static-v1.va-api.net',
    endpointId: '81',
    apiKey: 'dbf71e74380f37ba38640ca79f96fa1b'
  }; // アプリバージョン設定（本番はv1.0、テストはv1.1）
  // ※VAMにバージョン設定機能がつくまでの間の暫定仕様

  var isProduction = parseInt(envGiven.endpointId) % 2 === 1;
  envGiven.chatAppVersion = isProduction ? 'v1.0' : 'v1.1';
  envGiven.endpointUrl = "".concat(envGiven.apiServerUrl, "/api/Endpoints");
  envGiven.statusApiUrl = "".concat(envGiven.staticServerUrl, "/api/Statuses/va-service.json"); // グローバルから受け取る設定

  var envGlobal = {};
  if (w.__VA_API_SERVER_URL__) envGlobal.apiServerUrl = w.__VA_API_SERVER_URL__.replace(/\/$/, '');
  if (w.__VA_STATIC_SERVER_URL__) envGlobal.staticServerUrl = w.__VA_STATIC_SERVER_URL__.replace(/\/$/, '');
  if (w.__VA_ENDPOINT_ID__) envGlobal.endpointId = w.__VA_ENDPOINT_ID__;
  if (w.__VA_APIKEY__) envGlobal.apiKey = w.__VA_APIKEY__;
  if (w.__VA_ENDPOINT_URL__) envGlobal.endpointUrl = w.__VA_ENDPOINT_URL__.replace(/\/$/, '');
  if (w.__VA_STATUS_API_URL__) envGlobal.statusApiUrl = w.__VA_STATUS_API_URL__;
  if (w.__VA_STATIC_BASE_URL__) envGlobal.staticBaseUrl = w.__VA_STATIC_BASE_URL__.replace(/\/$/, '');
  if (w.__VA_CHAT_APP_VERSION__) envGlobal.chatAppVersion = String(w.__VA_CHAT_APP_VERSION__); // 補完

  if (!envGlobal.endpointUrl && envGlobal.apiServerUrl) envGlobal.endpointUrl = "".concat(envGlobal.apiServerUrl, "/api/Endpoints");
  if (!envGlobal.statusApiUrl && envGlobal.staticServerUrl) envGlobal.statusApiUrl = "".concat(envGlobal.staticServerUrl, "/api/Statuses/va-service.json"); // 設定を合成（グローバル優先）

  var env = _objectSpread({}, envGiven, {}, envGlobal);

  if (!env.staticBaseUrl) env.staticBaseUrl = "".concat(env.staticServerUrl, "/api/Endpoints/").concat(env.endpointId); // グローバル経由で関数受け取り（なかったらデフォルト値）

  var getInitType = w[i][e] || getInitTypeDefault;
  var getInitMode = w[i][s] || getInitModeDefault;
  var configureVa = w[i][n]; // UIタイプとUIモードを決定

  env.initType = getInitType();
  env.initMode = getInitMode(); // UIタイプ決定結果に基づいて、読み込むファイルを決定

  env.pathToCss = "".concat(env.staticBaseUrl, "/va-").concat(env.initType.toLowerCase(), ".css");
  env.pathToJs = "".concat(env.staticServerUrl, "/chatapp/").concat(env.chatAppVersion, "/va.js");
  env.pathToConfig = "".concat(env.staticBaseUrl, "/va-config.json");

  var onDOMContentLoaded = function onDOMContentLoaded() {
    var VA = w.VA;
    getConfigAndStatus(VA, env).then(function (_ref) {
      var _ref2 = _slicedToArray(_ref, 2),
          vaConfig = _ref2[0],
          vaStatus = _ref2[1];

      // VA Serviceがダウンしている場合はUIも起動しない
      if (vaStatus.data.status === 'fail') {
        console.log('VA Service is currently unavailable.');
        return;
      }

      var uiParams = vaConfig && vaConfig.data && vaConfig.data.uiParams || {}; // initObjectの作成

      var initObject = _objectSpread({}, env);

      if (w.vaDataQueue) {
        w.vaDataQueue.forEach(function (data) {
          var path = data[0];
          var value = data[1];
          var pathToLast = path.split('.');
          var lastKey = pathToLast.pop();
          var targetObject = pathToLast.reduce(function (memo, key) {
            memo[key] = memo[key] || {};
            return memo[key];
          }, initObject);
          targetObject[lastKey] = value;
        });
      } // ページ別設定の合成（マッチしたロケーション全部の設定を頭から合成。後ろほど優先）
      // 現在のURLとして、もしパラメータ「va-location」で指定があれば、本物の代わりにそれを使う


      var currentUrl = VA.URI(w.location.href).search(true)['va-location'] || w.location.href;
      var locations = uiParams.locations || [];
      var matchedLocations = locations.reduce(function (memo, location) {
        var matcher = new VA.UrlMatch(location.pattern);
        if (matcher.test(currentUrl)) memo.push(location);
        return memo;
      }, []);
      var thisLocationConfig = matchedLocations.reduce(function (memo, location) {
        return VA.jq.extend(true, memo, location.config);
      }, {}); // 設定オブジェクトの合成（initObject > ページ別 > デバイス別 > デフォルト の順に優先)

      var thisDefault = uiParams.default || {};
      var devices = uiParams.devices || {};
      var thisDevice = devices[env.initType] || {};
      var config = VA.jq.extend(true, thisDefault.config, thisDevice.config, thisLocationConfig, initObject); // もしどこにもセレクタ定義が存在しなかったらデフォルト値を設定

      config.selector = config.selector || '#va-root';
      VA.init(env.initType, initObject);
      configureVa(config);
    }).catch(function (error) {
      console.error(error);
    });
  }; // 実行


  var link = w.document.createElement('link');
  link.href = env.pathToCss;
  link.rel = 'stylesheet';
  link.type = 'text/css';
  var head = w.document.getElementsByTagName('head')[0];
  head.appendChild(link);
  var tag = w.document.getElementsByTagName('script')[0];
  var el = w.document.createElement('script');
  el.defer = true;
  el.src = env.pathToJs;
  el.charset = 'utf-8';

  el.onload = function () {
    if (document.readyState !== "loading") return onDOMContentLoaded();
    document.addEventListener('DOMContentLoaded', onDOMContentLoaded);
  };

  tag.parentNode.insertBefore(el, tag);
  /**
   * 設定とステータスを並列で取得する
   * @param VA
   * @param env
   * @returns {VA.Promise}
   */

  function getConfigAndStatus(VA, env) {
    return new VA.Promise(function (resolve, reject) {
      VA.axios.all([VA.axios.get(env.pathToConfig), VA.axios.get(env.statusApiUrl)]).then(VA.axios.spread(function (vaConfig, vaStatus) {
        resolve([vaConfig, vaStatus]);
      })).catch(function (error) {
        console.error(error);
        reject(error);
      });
    });
  } // UIタイプ決定ロジックのデフォルト


  function getInitTypeDefault() {
    var ua = w.navigator.userAgent.toLowerCase();
    var isMobile = ua.indexOf('windows') !== -1 && ua.indexOf('phone') !== -1 || ua.indexOf('iphone') !== -1 || ua.indexOf('ipod') !== -1 || ua.indexOf('android') !== -1 && ua.indexOf('mobile') !== -1 || ua.indexOf('firefox') !== -1 && ua.indexOf('mobile') !== -1 || ua.indexOf('blackberry') !== -1;
    return isMobile ? 'SP' : 'PC';
  } // UIモード決定ロジックのデフォルト


  function getInitModeDefault() {
    var ua = w.navigator.userAgent.toLowerCase();
    var isIPadOS = ua.indexOf('mac os') !== -1 && typeof document.ontouchstart !== 'undefined';
    var isTablet = isIPadOS || ua.indexOf('ipad') !== -1 || ua.indexOf('android') !== -1 && ua.indexOf('mobile') === -1 || ua.indexOf('firefox') !== -1 && ua.indexOf('tablet') !== -1;
    return {
      tabletMode: isTablet
    };
  }
})(window, 'VirtualAgentObject', 'configureVa', 'getInitType', 'getInitMode');
