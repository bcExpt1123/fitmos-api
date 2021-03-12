# Customer

APIs for managing  customer

## get weights.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/weights" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/weights"
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
<div id="execution-results-GETapi-customers-weights" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers-weights"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers-weights"></code></pre>
</div>
<div id="execution-error-GETapi-customers-weights" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers-weights"></code></pre>
</div>
<form id="form-GETapi-customers-weights" data-method="GET" data-path="api/customers/weights" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers-weights', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers-weights" onclick="tryItOut('GETapi-customers-weights');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers-weights" onclick="cancelTryOut('GETapi-customers-weights');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers-weights" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/weights</code></b>
</p>
<p>
<label id="auth-GETapi-customers-weights" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers-weights" data-component="header"></label>
</p>
</form>


## delete weight.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X DELETE \
    "http://127.0.0.4/api/customers/weights" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/weights"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-DELETEapi-customers-weights" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-customers-weights"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-customers-weights"></code></pre>
</div>
<div id="execution-error-DELETEapi-customers-weights" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-customers-weights"></code></pre>
</div>
<form id="form-DELETEapi-customers-weights" data-method="DELETE" data-path="api/customers/weights" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-customers-weights', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-customers-weights" onclick="tryItOut('DELETEapi-customers-weights');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-customers-weights" onclick="cancelTryOut('DELETEapi-customers-weights');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-customers-weights" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/customers/weights</code></b>
</p>
<p>
<label id="auth-DELETEapi-customers-weights" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-customers-weights" data-component="header"></label>
</p>
</form>


## update weight.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X PUT \
    "http://127.0.0.4/api/customers/weights" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/weights"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-PUTapi-customers-weights" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-customers-weights"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-customers-weights"></code></pre>
</div>
<div id="execution-error-PUTapi-customers-weights" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-customers-weights"></code></pre>
</div>
<form id="form-PUTapi-customers-weights" data-method="PUT" data-path="api/customers/weights" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-customers-weights', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-customers-weights" onclick="tryItOut('PUTapi-customers-weights');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-customers-weights" onclick="cancelTryOut('PUTapi-customers-weights');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-customers-weights" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/customers/weights</code></b>
</p>
<p>
<label id="auth-PUTapi-customers-weights" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-customers-weights" data-component="header"></label>
</p>
</form>


## create weight.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/weights" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/weights"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-weights" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-weights"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-weights"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-weights" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-weights"></code></pre>
</div>
<form id="form-POSTapi-customers-weights" data-method="POST" data-path="api/customers/weights" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-weights', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-weights" onclick="tryItOut('POSTapi-customers-weights');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-weights" onclick="cancelTryOut('POSTapi-customers-weights');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-weights" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/weights</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-weights" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-weights" data-component="header"></label>
</p>
</form>


## get all conditions.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/conditions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/conditions"
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
<div id="execution-results-GETapi-customers-conditions" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers-conditions"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers-conditions"></code></pre>
</div>
<div id="execution-error-GETapi-customers-conditions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers-conditions"></code></pre>
</div>
<form id="form-GETapi-customers-conditions" data-method="GET" data-path="api/customers/conditions" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers-conditions', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers-conditions" onclick="tryItOut('GETapi-customers-conditions');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers-conditions" onclick="cancelTryOut('GETapi-customers-conditions');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers-conditions" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/conditions</code></b>
</p>
<p>
<label id="auth-GETapi-customers-conditions" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers-conditions" data-component="header"></label>
</p>
</form>


## previous condition.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/previousCondition" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/previousCondition"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-previousCondition" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-previousCondition"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-previousCondition"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-previousCondition" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-previousCondition"></code></pre>
</div>
<form id="form-POSTapi-customers-previousCondition" data-method="POST" data-path="api/customers/previousCondition" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-previousCondition', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-previousCondition" onclick="tryItOut('POSTapi-customers-previousCondition');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-previousCondition" onclick="cancelTryOut('POSTapi-customers-previousCondition');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-previousCondition" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/previousCondition</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-previousCondition" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-previousCondition" data-component="header"></label>
</p>
</form>


## next condition.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/nextCondition" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/nextCondition"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-nextCondition" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-nextCondition"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-nextCondition"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-nextCondition" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-nextCondition"></code></pre>
</div>
<form id="form-POSTapi-customers-nextCondition" data-method="POST" data-path="api/customers/nextCondition" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-nextCondition', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-nextCondition" onclick="tryItOut('POSTapi-customers-nextCondition');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-nextCondition" onclick="cancelTryOut('POSTapi-customers-nextCondition');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-nextCondition" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/nextCondition</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-nextCondition" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-nextCondition" data-component="header"></label>
</p>
</form>


## change condition.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/changeCondition" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/changeCondition"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-changeCondition" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-changeCondition"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-changeCondition"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-changeCondition" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-changeCondition"></code></pre>
</div>
<form id="form-POSTapi-customers-changeCondition" data-method="POST" data-path="api/customers/changeCondition" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-changeCondition', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-changeCondition" onclick="tryItOut('POSTapi-customers-changeCondition');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-changeCondition" onclick="cancelTryOut('POSTapi-customers-changeCondition');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-changeCondition" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/changeCondition</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-changeCondition" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-changeCondition" data-component="header"></label>
</p>
</form>


## change object.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/changeObjective" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/changeObjective"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-changeObjective" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-changeObjective"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-changeObjective"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-changeObjective" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-changeObjective"></code></pre>
</div>
<form id="form-POSTapi-customers-changeObjective" data-method="POST" data-path="api/customers/changeObjective" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-changeObjective', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-changeObjective" onclick="tryItOut('POSTapi-customers-changeObjective');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-changeObjective" onclick="cancelTryOut('POSTapi-customers-changeObjective');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-changeObjective" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/changeObjective</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-changeObjective" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-changeObjective" data-component="header"></label>
</p>
</form>


## change weights.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/changeWeights" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/changeWeights"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-changeWeights" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-changeWeights"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-changeWeights"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-changeWeights" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-changeWeights"></code></pre>
</div>
<form id="form-POSTapi-customers-changeWeights" data-method="POST" data-path="api/customers/changeWeights" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-changeWeights', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-changeWeights" onclick="tryItOut('POSTapi-customers-changeWeights');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-changeWeights" onclick="cancelTryOut('POSTapi-customers-changeWeights');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-changeWeights" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/changeWeights</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-changeWeights" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-changeWeights" data-component="header"></label>
</p>
</form>


## recent workouts.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/recentWorkouts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/recentWorkouts"
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
<div id="execution-results-GETapi-customers-recentWorkouts" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers-recentWorkouts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers-recentWorkouts"></code></pre>
</div>
<div id="execution-error-GETapi-customers-recentWorkouts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers-recentWorkouts"></code></pre>
</div>
<form id="form-GETapi-customers-recentWorkouts" data-method="GET" data-path="api/customers/recentWorkouts" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers-recentWorkouts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers-recentWorkouts" onclick="tryItOut('GETapi-customers-recentWorkouts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers-recentWorkouts" onclick="cancelTryOut('GETapi-customers-recentWorkouts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers-recentWorkouts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/recentWorkouts</code></b>
</p>
<p>
<label id="auth-GETapi-customers-recentWorkouts" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers-recentWorkouts" data-component="header"></label>
</p>
</form>


## register activity.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/activity" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/activity"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-activity" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-activity"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-activity"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-activity" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-activity"></code></pre>
</div>
<form id="form-POSTapi-customers-activity" data-method="POST" data-path="api/customers/activity" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-activity', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-activity" onclick="tryItOut('POSTapi-customers-activity');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-activity" onclick="cancelTryOut('POSTapi-customers-activity');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-activity" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/activity</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-activity" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-activity" data-component="header"></label>
</p>
</form>


## redirect youtubelink.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/link" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/link"
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
<div id="execution-results-GETapi-customers-link" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers-link"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers-link"></code></pre>
</div>
<div id="execution-error-GETapi-customers-link" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers-link"></code></pre>
</div>
<form id="form-GETapi-customers-link" data-method="GET" data-path="api/customers/link" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers-link', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers-link" onclick="tryItOut('GETapi-customers-link');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers-link" onclick="cancelTryOut('GETapi-customers-link');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers-link" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/link</code></b>
</p>
<p>
<label id="auth-GETapi-customers-link" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers-link" data-component="header"></label>
</p>
</form>


## show a customer credit card.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/ccard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/ccard"
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
<div id="execution-results-GETapi-customers-ccard" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers-ccard"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers-ccard"></code></pre>
</div>
<div id="execution-error-GETapi-customers-ccard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers-ccard"></code></pre>
</div>
<form id="form-GETapi-customers-ccard" data-method="GET" data-path="api/customers/ccard" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers-ccard', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers-ccard" onclick="tryItOut('GETapi-customers-ccard');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers-ccard" onclick="cancelTryOut('GETapi-customers-ccard');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers-ccard" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/ccard</code></b>
</p>
<p>
<label id="auth-GETapi-customers-ccard" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers-ccard" data-component="header"></label>
</p>
</form>


## get referral.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/referral" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/referral"
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
<div id="execution-results-GETapi-customers-referral" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers-referral"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers-referral"></code></pre>
</div>
<div id="execution-error-GETapi-customers-referral" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers-referral"></code></pre>
</div>
<form id="form-GETapi-customers-referral" data-method="GET" data-path="api/customers/referral" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers-referral', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers-referral" onclick="tryItOut('GETapi-customers-referral');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers-referral" onclick="cancelTryOut('GETapi-customers-referral');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers-referral" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/referral</code></b>
</p>
<p>
<label id="auth-GETapi-customers-referral" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers-referral" data-component="header"></label>
</p>
</form>


## get partners.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/partners" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/partners"
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
<div id="execution-results-GETapi-customers-partners" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers-partners"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers-partners"></code></pre>
</div>
<div id="execution-error-GETapi-customers-partners" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers-partners"></code></pre>
</div>
<form id="form-GETapi-customers-partners" data-method="GET" data-path="api/customers/partners" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers-partners', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers-partners" onclick="tryItOut('GETapi-customers-partners');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers-partners" onclick="cancelTryOut('GETapi-customers-partners');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers-partners" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/partners</code></b>
</p>
<p>
<label id="auth-GETapi-customers-partners" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers-partners" data-component="header"></label>
</p>
</form>


## trigger workout.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/trigger-workout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/trigger-workout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-trigger-workout" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-trigger-workout"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-trigger-workout"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-trigger-workout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-trigger-workout"></code></pre>
</div>
<form id="form-POSTapi-customers-trigger-workout" data-method="POST" data-path="api/customers/trigger-workout" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-trigger-workout', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-trigger-workout" onclick="tryItOut('POSTapi-customers-trigger-workout');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-trigger-workout" onclick="cancelTryOut('POSTapi-customers-trigger-workout');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-trigger-workout" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/trigger-workout</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-trigger-workout" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-trigger-workout" data-component="header"></label>
</p>
</form>


## trigger notofiable.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/trigger-notifiable" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/trigger-notifiable"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-trigger-notifiable" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-trigger-notifiable"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-trigger-notifiable"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-trigger-notifiable" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-trigger-notifiable"></code></pre>
</div>
<form id="form-POSTapi-customers-trigger-notifiable" data-method="POST" data-path="api/customers/trigger-notifiable" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-trigger-notifiable', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-trigger-notifiable" onclick="tryItOut('POSTapi-customers-trigger-notifiable');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-trigger-notifiable" onclick="cancelTryOut('POSTapi-customers-trigger-notifiable');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-trigger-notifiable" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/trigger-notifiable</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-trigger-notifiable" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-trigger-notifiable" data-component="header"></label>
</p>
</form>


## show alternate shortcode.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/alternate-shortcode" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/alternate-shortcode"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-alternate-shortcode" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-alternate-shortcode"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-alternate-shortcode"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-alternate-shortcode" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-alternate-shortcode"></code></pre>
</div>
<form id="form-POSTapi-customers-alternate-shortcode" data-method="POST" data-path="api/customers/alternate-shortcode" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-alternate-shortcode', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-alternate-shortcode" onclick="tryItOut('POSTapi-customers-alternate-shortcode');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-alternate-shortcode" onclick="cancelTryOut('POSTapi-customers-alternate-shortcode');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-alternate-shortcode" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/alternate-shortcode</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-alternate-shortcode" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-alternate-shortcode" data-component="header"></label>
</p>
</form>


## get people.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/people" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/people"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-people" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-people"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-people"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-people" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-people"></code></pre>
</div>
<form id="form-POSTapi-customers-people" data-method="POST" data-path="api/customers/people" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-people', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-people" onclick="tryItOut('POSTapi-customers-people');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-people" onclick="cancelTryOut('POSTapi-customers-people');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-people" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/people</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-people" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-people" data-component="header"></label>
</p>
</form>


## get newsfeed.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/newsfeed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/newsfeed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-newsfeed" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-newsfeed"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-newsfeed"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-newsfeed" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-newsfeed"></code></pre>
</div>
<form id="form-POSTapi-customers-newsfeed" data-method="POST" data-path="api/customers/newsfeed" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-newsfeed', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-newsfeed" onclick="tryItOut('POSTapi-customers-newsfeed');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-newsfeed" onclick="cancelTryOut('POSTapi-customers-newsfeed');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-newsfeed" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/newsfeed</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-newsfeed" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-newsfeed" data-component="header"></label>
</p>
</form>


## get old newsfeed.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.4/api/customers/oldnewsfeed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/oldnewsfeed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
<div id="execution-results-POSTapi-customers-oldnewsfeed" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-customers-oldnewsfeed"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers-oldnewsfeed"></code></pre>
</div>
<div id="execution-error-POSTapi-customers-oldnewsfeed" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers-oldnewsfeed"></code></pre>
</div>
<form id="form-POSTapi-customers-oldnewsfeed" data-method="POST" data-path="api/customers/oldnewsfeed" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers-oldnewsfeed', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-customers-oldnewsfeed" onclick="tryItOut('POSTapi-customers-oldnewsfeed');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-customers-oldnewsfeed" onclick="cancelTryOut('POSTapi-customers-oldnewsfeed');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-customers-oldnewsfeed" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/customers/oldnewsfeed</code></b>
</p>
<p>
<label id="auth-POSTapi-customers-oldnewsfeed" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-customers-oldnewsfeed" data-component="header"></label>
</p>
</form>


## show customer profile.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers/qui/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers/qui/profile"
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
<div id="execution-results-GETapi-customers--id--profile" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers--id--profile"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers--id--profile"></code></pre>
</div>
<div id="execution-error-GETapi-customers--id--profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers--id--profile"></code></pre>
</div>
<form id="form-GETapi-customers--id--profile" data-method="GET" data-path="api/customers/{id}/profile" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers--id--profile', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers--id--profile" onclick="tryItOut('GETapi-customers--id--profile');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers--id--profile" onclick="cancelTryOut('GETapi-customers--id--profile');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers--id--profile" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers/{id}/profile</code></b>
</p>
<p>
<label id="auth-GETapi-customers--id--profile" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers--id--profile" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-customers--id--profile" data-component="url" required  hidden>
<br>
</p>
</form>


## search customers.

<small class="badge badge-darkred">requires authentication</small>

This endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.4/api/customers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://127.0.0.4/api/customers"
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
<div id="execution-results-GETapi-customers" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-customers"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers"></code></pre>
</div>
<div id="execution-error-GETapi-customers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers"></code></pre>
</div>
<form id="form-GETapi-customers" data-method="GET" data-path="api/customers" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-customers', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-customers" onclick="tryItOut('GETapi-customers');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-customers" onclick="cancelTryOut('GETapi-customers');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-customers" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/customers</code></b>
</p>
<p>
<label id="auth-GETapi-customers" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-customers" data-component="header"></label>
</p>
</form>


