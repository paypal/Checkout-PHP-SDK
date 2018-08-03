## 0.3.0
- Add support for multipart/form-data with JSON parts

## 0.2.4
- Use CURLOPT_HEADERFUNCTION for parsing response headers.

## 0.2.3
- Ensure immutability of requests passed to HttpClient#execute
- Use wiremock for our tests
- Refactor response parsing

## 0.2.2
- Add gzip compression/decompression.

## 0.2.1
- Relax json content-type regex to allow content types with charset to be parset correctly.

## 0.2.0
- Expose Encoder in HttpClient.
- Support x-www-form-urlencoded post bodies.

## 0.1.1
- Fix deserialization attempt of emtpy response body.

## 0.1.0
- First release
