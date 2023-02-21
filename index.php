<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/grid.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <title>Blog</title>
</head>

<body>

    <?php
    include 'components/header/index.php';
    include 'components/content/index.php';
    include 'components/footer/index.php';
    ?>

    <script>
        const getData = async () => {
            const response = await fetch(`https://test.borndigital.ba/wp-json/wp/v2/posts/?_embed`)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    data.forEach(item => {
                        const markup = `
                        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="content-card">
                                <img src="${item._embedded['wp:featuredmedia']['0'].source_url ? item._embedded['wp:featuredmedia']['0'].source_url : 'no image'}" alt="${item.title.rendered ? item.title.rendered : 'article image'}" />
                                <h2>
                                    ${item.title.rendered ? item.title.rendered : ''}
                                </h2>
                                <p>
                                    ${item.content.rendered ? item.content.rendered : ''}
                                </p>
                                <a href="https://test.borndigital.ba/${item.slug}">
                                    <button>
                                        Read full article
                                    </button>
                                </a>
                                <a href="#">
                                    <span>
                                        Edit
                                    </span>
                                </a>
                                <a href="#">
                                    <span>
                                        Delete
                                    </span>
                                </a>
                            </div>
                        </div>
                    `;

                        document.querySelector('.content-posts').insertAdjacentHTML('beforeend', markup);
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        };

        const deleteData = async (id) => {
            const response = await fetch(`https://test.borndigital.ba/wp-json/wp/v2/posts/${id}`, {
                method: 'DELETE'
            });
        };

        getData();
    </script>

</body>

</html>