# Chat

APIs for managing  chat

## verify.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/chat/verify" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/chat/verify"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-GETapi-chat-verify" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-chat-verify"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chat-verify"></code></pre>
</div>
<div id="execution-error-GETapi-chat-verify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chat-verify"></code></pre>
</div>
<form id="form-GETapi-chat-verify" data-method="GET" data-path="api/chat/verify" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-chat-verify', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-chat-verify" onclick="tryItOut('GETapi-chat-verify');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-chat-verify" onclick="cancelTryOut('GETapi-chat-verify');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-chat-verify" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/chat/verify</code></b>
</p>
<p>
<label id="auth-GETapi-chat-verify" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-chat-verify" data-component="header"></label>
</p>
</form>


## verify from local.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/chat/verify-local" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/chat/verify-local"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-GETapi-chat-verify-local" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-chat-verify-local"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chat-verify-local"></code></pre>
</div>
<div id="execution-error-GETapi-chat-verify-local" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chat-verify-local"></code></pre>
</div>
<form id="form-GETapi-chat-verify-local" data-method="GET" data-path="api/chat/verify-local" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-chat-verify-local', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-chat-verify-local" onclick="tryItOut('GETapi-chat-verify-local');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-chat-verify-local" onclick="cancelTryOut('GETapi-chat-verify-local');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-chat-verify-local" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/chat/verify-local</code></b>
</p>
<p>
<label id="auth-GETapi-chat-verify-local" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-chat-verify-local" data-component="header"></label>
</p>
</form>



