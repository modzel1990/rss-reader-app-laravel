<h3>Instructions</h3>
<p>Once you clone the app please make sure to set up database in .env file. If you do not have .env file there should be .env.example which can be used as a template.</p>
<ul>
<li>DB_CONNECTION=mysql</li>
<li>DB_HOST=127.0.0.1</li>
<li>DB_PORT=3306</li>
<li>DB_DATABASE={your_db_name}</li>
<li>DB_USERNAME={your_root_name}</li>
<li>DB_PASSWORD={your_password}</li>
</ul>
<p>When you provide credentials to your db, you will need to run <strong>'php artisan migrate'</strong> command in order to build necessary tables within your db</p>
<p>Furthermore, you can run server with <strong>'php artisan serve'</strong> and in separate terminal you might need to run <strong>'npm install'</strong> and <strong>'npm run dev'</strong>.</p>

<h4>The App</h4>
<p>The app is quite simple to use. You will land on main page where in right top corner you will see Login and Register buttons. No need to explain what they do.<br>
Once you register and login you will land on a /home page with Dashboard. On dashboard you should see two buttons:
</p>
<ul>
<li>RSS Feeds Controller</li>
<li>Show RSS Feeds</li>
</ul>
<p>First one will take you to the area where you can add new RSS name and RSS url, see their content, edit or delete them.</p>
<p>Second one will take you to the list of all RSS Feeds that you have already added</p>
<p>If you need to get back to the Dashboard (/home) you will find Home button on top right corner.</p>

<p>I've used simple bootstrap for layout and buttons, there is no doubt this could be done smarter and more user friendly, but due to lack of time I focused mainly on its functionality.</p>
