;(function () {
    var publishCard = function(element) {
        axios.put(element.dataset.url, {
            published: 1
        })
            .then(function (response) {
                element.classList.remove('fa-eye');
                element.classList.remove('js-publish-card');

                element.classList.add('js-unpublish-card');
                element.classList.add('fa-eye-slash');
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    var unpublishCard = function(element) {
        axios.put(element.dataset.url, {
            published: 0
        })
            .then(function (response) {
                element.classList.remove('js-unpublish-card');
                element.classList.remove('fa-eye-slash');

                element.classList.add('fa-eye');
                element.classList.add('js-publish-card');
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    var deleteCard = function(element) {
        axios.delete(element.dataset.url)
            .then(function (response) {
                element.closest('tr').remove();
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    document.addEventListener('click', function (e) {

        if (e.target.classList.contains('js-publish-card')) {
            publishCard(e.target);
        }

        if (e.target.classList.contains('js-unpublish-card')) {
            unpublishCard(e.target);
        }

        if (e.target.classList.contains('js-delete-card')) {
            deleteCard(e.target);
        }
    })
})();
