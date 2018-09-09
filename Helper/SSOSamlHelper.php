<?php

class SSOSamlHelper extends \OxidEsales\Eshop\Core\Utils {

    public static function getSettingsArray() {

        return array (
            // If 'strict' is True, then the PHP Toolkit will reject unsigned
            // or unencrypted messages if it expects them signed or encrypted
            // Also will reject the messages if not strictly follow the SAML
            // standard: Destination, NameId, Conditions ... are validated too.
            'strict' => false,

            // Enable debug mode (to print errors)
            'debug' => false,

            // Set a BaseURL to be used instead of try to guess
            // the BaseURL of the view that process the SAML Message.
            // Ex. http://sp.example.com/
            //     http://example.com/sp/
            'baseurl' => 'http://oxid6/llama',

            // Service Provider Data that we are deploying
            //'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
            //'Location' => 'http://oxid6/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',

            'sp' => array (
                // Identifier of the SP entity  (must be a URI)
                'entityId' => 'http://oxid6-1',
                // Specifies info about where and how the <AuthnResponse> message MUST be
                // returned to the requester, in this case our SP.
                'assertionConsumerService' => array (
                    // URL Location where the <Response> from the IdP will be returned
                    'url' => 'http://oxid6/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
                    // SAML protocol binding to be used when returning the <Response>
                    // message.  Onelogin Toolkit supports for this endpoint the
                    // HTTP-Redirect binding only
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),
                // If you need to specify requested attributes, set a
                // attributeConsumingService. nameFormat, attributeValue and
                // friendlyName can be omitted. Otherwise remove this section.
                "attributeConsumingService"=> array(
                    "ServiceName" => "SP test",
                    "serviceDescription" => "Test Service",
                    "requestedAttributes" => array(
                        array(
                            "name" => "",
                            "isRequired" => false,
                            "nameFormat" => "",
                            "friendlyName" => "",
                            "attributeValue" => ""
                        )
                    )
                ),
                // Specifies info about where and how the <Logout Response> message MUST be
                // returned to the requester, in this case our SP.

                //'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                //'Location' => 'http://oxid6/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',

                'singleLogoutService' => array (
                    // URL Location where the <Response> from the IdP will be returned
                    'url' => 'http://oxid6/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
                    // SAML protocol binding to be used when returning the <Response>
                    // message.  Onelogin Toolkit supports for this endpoint the
                    // HTTP-Redirect binding only
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                // Specifies constraints on the name identifier to be used to
                // represent the requested subject.
                // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
                'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',

                // Usually x509cert and privateKey of the SP are provided by files placed at
                // the certs folder. But we can also provide them with the following parameters
                'x509cert' => '',
                'privateKey' => '',

                /*
                 * Key rollover
                 * If you plan to update the SP x509cert and privateKey
                 * you can define here the new x509cert and it will be
                 * published on the SP metadata so Identity Providers can
                 * read them and get ready for rollover.
                 */
                // 'x509certNew' => '',
            ),

            // Identity Provider Data that we want connect with our SP

            //'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
            //'Location' => 'http://oxid6-1/simplesaml/saml2/idp/SSOService.php'

            'idp' => array (
                // Identifier of the IdP entity  (must be a URI)
                'entityId' => 'http://oxid6-1',
                // SSO endpoint info of the IdP. (Authentication Request protocol)
                'singleSignOnService' => array (
                    // URL Target of the IdP where the SP will send the Authentication Request Message
                    'url' => 'http://oxid6-1/simplesaml/saml2/idp/SSOService.php',
                    // SAML protocol binding to be used when returning the <Response>
                    // message.  Onelogin Toolkit supports for this endpoint the
                    // HTTP-POST binding only
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                // SLO endpoint info of the IdP.
                //'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                //'Location' => 'http://oxid6-1/simplesaml/saml2/idp/SingleLogoutService.php'

                'singleLogoutService' => array (
                    // URL Location of the IdP where the SP will send the SLO Request
                    'url' => 'http://oxid6-1/simplesaml/saml2/idp/SingleLogoutService.php',
                    // SAML protocol binding to be used when returning the <Response>
                    // message.  Onelogin Toolkit supports for this endpoint the
                    // HTTP-Redirect binding only
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                // Public x509 certificate of the IdP
                'x509cert' => 'MIID7jCCAtagAwIBAgIJAKe8Gg/Tlme2MA0GCSqGSIb3DQEBCwUAMIGLMQswCQYDVQQGEwJERTEPMA0GA1UECAwGQmVybGluMQ8wDQYDVQQHDAZCZXJsaW4xITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDEOMAwGA1UEAwwFbGxhbWExJzAlBgkqhkiG9w0BCQEWGHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTAeFw0xODA5MDQxNDMwMjVaFw0yODA5MDMxNDMwMjVaMIGLMQswCQYDVQQGEwJERTEPMA0GA1UECAwGQmVybGluMQ8wDQYDVQQHDAZCZXJsaW4xITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDEOMAwGA1UEAwwFbGxhbWExJzAlBgkqhkiG9w0BCQEWGHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBANlNeEayrzZd2dQXl/87nn2GR3ozxwbqhlIcUU27dKoayoVWKTxmVGOgo3t3viJ6evfMYqlRVb+3gx0tHDWpUjQ14GgzT983crlraTmauOjZFsC4pFOsGSmjqVKgP2+XyHn3PMpTRtZHU8gz7kcq+R0SNRnd1QEk0NCIkXkf51JV6COkIsVhFi7139/yD9vJrWiR7TR1CwyCo51sTO9q1chsUqHQnTjhRuyWOIkYAsNk7HdfMCpIuCUVrbGa9qrv6OM/X9CYrwoYg6BMCRZfQHwAs5oFcUL6aP0EiqgMEtWeqRCSUpZVVas8p6UvBpHHLCI1n8sxvuVylcFUU88qD3MCAwEAAaNTMFEwHQYDVR0OBBYEFPY2F6cHsf0agpzTQNoCxfmgozGbMB8GA1UdIwQYMBaAFPY2F6cHsf0agpzTQNoCxfmgozGbMA8GA1UdEwEB/wQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEBABnKBW+wF8ZsJ6ew4i7NsA0ooi38JB0ggkup9zRTPd8U3vLh7DHg7C73QH/tXeeVhwWt5frln9dqtaFxoZm2EhjN+NNL+pDknKHjwJHQIJKYUxribIW79TfulrElYEfRMVOgPXiD2yaBnQ71yC95bg+jcEUjCwtfJ7kfDg6b33x0pkh986o4PNw9nxWPau+TNYSSyAfBYvF4ppkJmAjvVOvxOrvcYpeCnFGOXw8AL+stXnUAVs8GVOVnZJaS+ByDbmk4LBo0t9JhEzlTBDQTI3g+7rGO9EVxaDOZn7h6sSdwEQG4zXmSGI6hS7ffUAoRgcVbwSulkZH8w3Z36kyf56k=',
                /*
                 *  Instead of use the whole x509cert you can use a fingerprint in
                 *  order to validate the SAMLResponse, but we don't recommend to use
                 *  that method on production since is exploitable by a collision
                 *  attack.
                 *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it,
                 *   or add for example the -sha256 , -sha384 or -sha512 parameter)
                 *
                 *  If a fingerprint is provided, then the certFingerprintAlgorithm is required in order to
                 *  let the toolkit know which Algorithm was used. Possible values: sha1, sha256, sha384 or sha512
                 *  'sha1' is the default value.
                 */
                // 'certFingerprint' => '',
                // 'certFingerprintAlgorithm' => 'sha1',

                /* In some scenarios the IdP uses different certificates for
                 * signing/encryption, or is under key rollover phase and more
                 * than one certificate is published on IdP metadata.
                 * In order to handle that the toolkit offers that parameter.
                 * (when used, 'x509cert' and 'certFingerprint' values are
                 * ignored).
                 */
                // 'x509certMulti' => array(
                //      'signing' => array(
                //          0 => '<cert1-string>',
                //      ),
                //      'encryption' => array(
                //          0 => '<cert2-string>',
                //      )
                // ),
            )
        );
    }
}