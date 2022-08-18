<b>THIS IS NOT COMPLETE YET, EXPECT THINGS TO BE MISSING</b>

<h2>LVForum</h2>
<p>LVForum is a pretty simple forum made with Laravel.</p>

<h3>Setup</h3>
<p>This assumes you want to set up a local server for testing and development.<br>
I can't tell how to deploy because I honestly don't know either.</p>

<ol>
    <li>
        Clone the repo
        <pre><code>git clone https://github.com/Fire-Ash/lvforum.git && cd lvforum</code></pre>
    </li>
    <li>
        Install dependencies
        <pre><code>composer install && npm install</code></pre>
    </li>
    <li>
        Generate a key for the app
        <pre><code>php artisan key:generate</code></pre>
    </li>
    <li>
        Setup a database
    </li>
    <li>
        Copy the .env.example file and fill it out with the proper values
        <pre><code>cp .env.example .env</code></pre>
    </li>
    <li>
        Create the root user
        <pre><code>php artisan root:create</code></pre>
        <b>make sure to change the root password with</b> <code>php artisan root:change</code>
    </li>
    <li>
        Run the server
        <pre><code>php artisan serve</code></pre>
        <pre><code>npm run dev</code></pre>
        (run these both at the same time)
    </li>
</ol>
