# Proxy

---

- [Overview](#overview)
- [Configuration](#configuration)

## Overview
This application supports built in proxy configuration for reverse proxies. This configuration **MUST** be set if you are using a reverse proxy. Reverse proxies may include load balancers and cache servers. If you are having issues with your website when this configuration is not set then it probably means that you have a proxy someplace between the web server and your users.

<a name="configuration"></a>
## Configuration
The proxy must be configured in the `config/trustedproxy.php` file. The accepted formats are as follows:
- Wildcard `*` accepts any proxy
- Direct `10.10.10.1` accepts only the proxy from the ip addresses specified
- CIDR `10.0.0.0/8` accepts any proxy from the specified network

The wildcard option is only suggested if you do not know the IP address of the reverse proxy, an example of this would be the AWS ELB service.

```php
return [
                   // Specfic IP Addresses   |  CIDR Address
    'proxies' => ['192.168.1.2', '192.168.1.3', '10.0.0.0/8'],

    // Wildcard
    // 'proxies' => '*'
];
```
