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

        form div.element{
            padding:10px;
        }

        .button {
            border: none;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            background-color: white; 
            color: black; 
            border: 2px solid #008CBA;
        }

        .button:hover {
            background-color: #008CBA;
            color: white;
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
                <h2 style="padding:10px;">Request Meeting</h2>

                <form action="#">
                    <div class="element">
                        <label for="receiver">To: </label>
                        <input type="text" id="receiver" name="receiver" placeholder="Enter name / email of the Lecturer" style="width:90%;"><br>
                    </div>

                    <div class="element">
                        <label for="Date">Date: </label>
                        <input type="date" id="Date" name="Date" min="today"><br>
                    </div>

                    <div class="element">
                        <label for="message">Message: </label>
                        <textarea name="message" rows="10" placeholder="type your message here" style="width:100%;"></textarea>
                    </div>

                    <div class="element">
                        <button class="button" type="submit">Send Request</button>
                    </div>
                </form>
            </div>
        </article>

        <article class="side">
        </article>

    </section>
</body>

</html>
