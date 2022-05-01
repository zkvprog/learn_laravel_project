;(function () {
    var publishArticle = function(element) {
        axios.put(element.dataset.url, {
            published: 1
        })
            .then(function (response) {
                element.classList.remove('fa-eye');
                element.classList.remove('js-publish-article');

                element.classList.add('js-unpublish-article');
                element.classList.add('fa-eye-slash');
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    var unpublishArticle = function(element) {
        axios.put(element.dataset.url, {
            published: 0
        })
            .then(function (response) {
                element.classList.remove('js-unpublish-article');
                element.classList.remove('fa-eye-slash');

                element.classList.add('fa-eye');
                element.classList.add('js-publish-article');
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    var deleteArticle = function(element) {
        axios.delete(element.dataset.url)
            .then(function (response) {
                element.closest('tr').remove();
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    document.addEventListener('click', function (e) {

        if(e.target.classList.contains('js-publish-article')) {
            publishArticle(e.target);
        }

        if(e.target.classList.contains('js-unpublish-article')) {
            unpublishArticle(e.target);
        }

        if(e.target.classList.contains('js-delete-article')) {
            deleteArticle(e.target);
        }
    })
})();
