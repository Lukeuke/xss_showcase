<style>
    .cookie-accept-bar {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
      z-index: 9999;
    }

    .cookie-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      font-size: 20px;
    }

    img {
        width: 5%;
    }
</style>

<div class="cookie-accept-bar">
    <div class="fw-bold">Ta strona używa ciasteczek do prawidłowego funkcjonowania.</div>
    <img src="./img/cookie.png" alt="cookies" />
    <div class="mt-2 mb-2">
        <button id="acceptBtn" class="btn btn-success">Akceptuj wszystkie</button>
        <button class="btn btn-danger" onclick="dontAccept();">Odrzuć</button>
    </div>
  </div>

  <script>
    function hasAcceptedCookies() {
      return document.cookie.split(';').some((item) => item.trim().startsWith('cookiesAccepted='));
    }

    function disableScroll() {
      document.body.style.overflow = 'hidden';
    }

    function enableScroll() {
      document.body.style.overflow = '';
    }

    function dontAccept() {
        history.back();
    }

    document.getElementById('acceptBtn').addEventListener('click', function() {
      document.cookie = 'cookiesAccepted=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';

      document.querySelector('.cookie-accept-bar').style.display = 'none';
      document.querySelector('.cookie-overlay').style.display = 'none';
      enableScroll();
    });

    if (!hasAcceptedCookies()) {
      disableScroll();
      const overlay = document.createElement('div');
      overlay.className = 'cookie-overlay';
      document.body.appendChild(overlay);
    }
  </script>