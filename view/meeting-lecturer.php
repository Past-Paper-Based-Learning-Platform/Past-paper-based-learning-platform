<! DOCTYPE html>

<head>
    <style>
        section:after {
            content: "";
            display: table;
            clear: both;
        }

        article.side {
            float: left;
            padding: 20px;
            width: 18%;
            background-color: #ccffff;
        }

        article.mid {
            float: left;
            padding:20px;
            width: 56%;
            background-color: #ccffff;
        }

        input.search {
            width: 95%;
        }

        div.container {
            width:100%;
            height:100%;
            border: 1px solid #000000;
            background-color: #33ffff;
        }
        </style>

</head>

<body>
    <section>

        <article class="side">
        </article>

        <article class="mid">
            <div style="padding-bottom:20px;">
                <input type="text" placeholder="Search.." name="search" class="search">
                <button type="submit">&#128269;</button>
            </div>

            <div class="container">
                <h2 style="padding:10px;">Schedule Meeting</h2>
            </div>
        </article>

        <article class="side">
        </article>
    </section>
</body>

</html>