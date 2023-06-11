<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script>
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    const btnTheme = document.getElementById('themeMode');
    const btnSwitch2 = document.getElementById('btnSwitch');
    if (getCookie("theme") == "light") {
        document.documentElement.setAttribute('data-bs-theme', 'light')
        btnTheme.innerHTML = '<i class="bi bi-brightness-high-fill"></i>';
        btnSwitch2.classList.remove('btn-dark');
        btnSwitch2.classList.add('btn-light');

    } else if (getCookie("theme") == "dark") {
        document.documentElement.setAttribute('data-bs-theme', 'dark')
        btnTheme.innerHTML = '<i class="bi bi-moon-fill"></i>';
        btnSwitch2.classList.remove('btn-light');
        btnSwitch2.classList.add('btn-dark');

    } else {
        document.documentElement.setAttribute('data-bs-theme', 'light')
        btnTheme.innerHTML = '<i class="bi bi-brightness-high-fill"></i>';
        btnSwitch2.classList.remove('btn-dark');
        btnSwitch2.classList.add('btn-light');

    }
    document.getElementById('btnSwitch').addEventListener('click', () => {

        if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'light')
            setCookie("theme", "light", 365);
            btnTheme.innerHTML = '<i class="bi bi-brightness-high-fill"></i>';
            btnSwitch2.classList.remove('btn-dark');
            btnSwitch2.classList.add('btn-light');

        } else {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
            setCookie("theme", "dark", 365);
            btnTheme.innerHTML = '<i class="bi bi-moon-fill"></i>';
            btnSwitch2.classList.remove('btn-light');
            btnSwitch2.classList.add('btn-dark');

        }
    })
</script>
</body>

</html>