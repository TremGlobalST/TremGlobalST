<h1>Meeting</h1>
<p>Meeting scheduler software of TremGlobal that wrote with Laravel and Vue.js</p>
<h2>Steps For Install</h2>
<ol>
<li>docker-compose up -d --build</li>
<li>docker exec -it meeting_php_1 /bin/bash</li>
<li>cd ../meeting</li>
<li>composer install</li>
<li>php artisan migrate</li>
<li>php artisan db:seed</li>
<li>yarn install</li>
<li>yarn dev</li>
<li>
insert <code>127.0.0.1 meeting.local www.meeting.local</code>
in your local hosts file
</li>
<li>visit http://meeting.local</li>
</ol>
