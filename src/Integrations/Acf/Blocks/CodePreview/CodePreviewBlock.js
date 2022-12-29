(function () {
    document
        .querySelectorAll(`[data-action="copyCodePreview"]`)
        .forEach(function (el) {

            el.addEventListener('click', function () {
                const code = el.parentElement.parentElement.querySelector('code');
                const text = code.textContent;
                navigator.clipboard.writeText(text)
                    .then(function () {
                        alert("Content has been copied.")
                    })
                    .catch(function () {
                        alert('Error! Can not copy.')
                    });
            })
        });
})();