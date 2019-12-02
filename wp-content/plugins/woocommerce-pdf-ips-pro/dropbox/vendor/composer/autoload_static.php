<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce29677b23f16b8eda94bac99a0deeb4
{
    public static $files = array (
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '25072dd6e2470089de65ae7bf11d3109' => __DIR__ . '/..' . '/symfony/polyfill-php72/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '7ba3c774c30c8399e359b5ff7f3b943e' => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate/Support/helpers.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php72\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'K' => 
        array (
            'Kunnu\\Dropbox\\' => 14,
        ),
        'I' => 
        array (
            'Illuminate\\' => 11,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php72\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php72',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Kunnu\\Dropbox\\' => 
        array (
            0 => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox',
        ),
        'Illuminate\\' => 
        array (
            0 => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
    );

    public static $classMap = array (
        'GuzzleHttp\\Client' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Client.php',
        'GuzzleHttp\\ClientInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/ClientInterface.php',
        'GuzzleHttp\\Cookie\\CookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/CookieJar.php',
        'GuzzleHttp\\Cookie\\CookieJarInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/CookieJarInterface.php',
        'GuzzleHttp\\Cookie\\FileCookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/FileCookieJar.php',
        'GuzzleHttp\\Cookie\\SessionCookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/SessionCookieJar.php',
        'GuzzleHttp\\Cookie\\SetCookie' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/SetCookie.php',
        'GuzzleHttp\\Exception\\BadResponseException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/BadResponseException.php',
        'GuzzleHttp\\Exception\\ClientException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ClientException.php',
        'GuzzleHttp\\Exception\\ConnectException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ConnectException.php',
        'GuzzleHttp\\Exception\\GuzzleException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/GuzzleException.php',
        'GuzzleHttp\\Exception\\RequestException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/RequestException.php',
        'GuzzleHttp\\Exception\\SeekException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/SeekException.php',
        'GuzzleHttp\\Exception\\ServerException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ServerException.php',
        'GuzzleHttp\\Exception\\TooManyRedirectsException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/TooManyRedirectsException.php',
        'GuzzleHttp\\Exception\\TransferException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/TransferException.php',
        'GuzzleHttp\\HandlerStack' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/HandlerStack.php',
        'GuzzleHttp\\Handler\\CurlFactory' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlFactory.php',
        'GuzzleHttp\\Handler\\CurlFactoryInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlFactoryInterface.php',
        'GuzzleHttp\\Handler\\CurlHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlHandler.php',
        'GuzzleHttp\\Handler\\CurlMultiHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php',
        'GuzzleHttp\\Handler\\EasyHandle' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/EasyHandle.php',
        'GuzzleHttp\\Handler\\MockHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/MockHandler.php',
        'GuzzleHttp\\Handler\\Proxy' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/Proxy.php',
        'GuzzleHttp\\Handler\\StreamHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/StreamHandler.php',
        'GuzzleHttp\\MessageFormatter' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/MessageFormatter.php',
        'GuzzleHttp\\Middleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Middleware.php',
        'GuzzleHttp\\Pool' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Pool.php',
        'GuzzleHttp\\PrepareBodyMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/PrepareBodyMiddleware.php',
        'GuzzleHttp\\Promise\\AggregateException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/AggregateException.php',
        'GuzzleHttp\\Promise\\CancellationException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/CancellationException.php',
        'GuzzleHttp\\Promise\\Coroutine' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Coroutine.php',
        'GuzzleHttp\\Promise\\EachPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/EachPromise.php',
        'GuzzleHttp\\Promise\\FulfilledPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/FulfilledPromise.php',
        'GuzzleHttp\\Promise\\Promise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Promise.php',
        'GuzzleHttp\\Promise\\PromiseInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/PromiseInterface.php',
        'GuzzleHttp\\Promise\\PromisorInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/PromisorInterface.php',
        'GuzzleHttp\\Promise\\RejectedPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/RejectedPromise.php',
        'GuzzleHttp\\Promise\\RejectionException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/RejectionException.php',
        'GuzzleHttp\\Promise\\TaskQueue' => __DIR__ . '/..' . '/guzzlehttp/promises/src/TaskQueue.php',
        'GuzzleHttp\\Promise\\TaskQueueInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/TaskQueueInterface.php',
        'GuzzleHttp\\Psr7\\AppendStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/AppendStream.php',
        'GuzzleHttp\\Psr7\\BufferStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/BufferStream.php',
        'GuzzleHttp\\Psr7\\CachingStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/CachingStream.php',
        'GuzzleHttp\\Psr7\\DroppingStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/DroppingStream.php',
        'GuzzleHttp\\Psr7\\FnStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/FnStream.php',
        'GuzzleHttp\\Psr7\\InflateStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/InflateStream.php',
        'GuzzleHttp\\Psr7\\LazyOpenStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/LazyOpenStream.php',
        'GuzzleHttp\\Psr7\\LimitStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/LimitStream.php',
        'GuzzleHttp\\Psr7\\MessageTrait' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MessageTrait.php',
        'GuzzleHttp\\Psr7\\MultipartStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MultipartStream.php',
        'GuzzleHttp\\Psr7\\NoSeekStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/NoSeekStream.php',
        'GuzzleHttp\\Psr7\\PumpStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/PumpStream.php',
        'GuzzleHttp\\Psr7\\Request' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Request.php',
        'GuzzleHttp\\Psr7\\Response' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Response.php',
        'GuzzleHttp\\Psr7\\ServerRequest' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/ServerRequest.php',
        'GuzzleHttp\\Psr7\\Stream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Stream.php',
        'GuzzleHttp\\Psr7\\StreamDecoratorTrait' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/StreamDecoratorTrait.php',
        'GuzzleHttp\\Psr7\\StreamWrapper' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/StreamWrapper.php',
        'GuzzleHttp\\Psr7\\UploadedFile' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UploadedFile.php',
        'GuzzleHttp\\Psr7\\Uri' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Uri.php',
        'GuzzleHttp\\Psr7\\UriNormalizer' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriNormalizer.php',
        'GuzzleHttp\\Psr7\\UriResolver' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriResolver.php',
        'GuzzleHttp\\RedirectMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RedirectMiddleware.php',
        'GuzzleHttp\\RequestOptions' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RequestOptions.php',
        'GuzzleHttp\\RetryMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RetryMiddleware.php',
        'GuzzleHttp\\TransferStats' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/TransferStats.php',
        'GuzzleHttp\\UriTemplate' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/UriTemplate.php',
        'Illuminate\\Contracts\\Support\\Arrayable' => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate/Contracts/Support/Arrayable.php',
        'Illuminate\\Contracts\\Support\\Jsonable' => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate/Contracts/Support/Jsonable.php',
        'Illuminate\\Support\\Arr' => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate/Support/Arr.php',
        'Illuminate\\Support\\Collection' => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate/Support/Collection.php',
        'Illuminate\\Support\\HigherOrderCollectionProxy' => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate/Support/HigherOrderCollectionProxy.php',
        'Illuminate\\Support\\Traits\\Macroable' => __DIR__ . '/..' . '/tightenco/collect/src/Illuminate/Support/Traits/Macroable.php',
        'Kunnu\\Dropbox\\Authentication\\DropboxAuthHelper' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Authentication/DropboxAuthHelper.php',
        'Kunnu\\Dropbox\\Authentication\\OAuth2Client' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Authentication/OAuth2Client.php',
        'Kunnu\\Dropbox\\Dropbox' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Dropbox.php',
        'Kunnu\\Dropbox\\DropboxApp' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/DropboxApp.php',
        'Kunnu\\Dropbox\\DropboxClient' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/DropboxClient.php',
        'Kunnu\\Dropbox\\DropboxFile' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/DropboxFile.php',
        'Kunnu\\Dropbox\\DropboxRequest' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/DropboxRequest.php',
        'Kunnu\\Dropbox\\DropboxResponse' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/DropboxResponse.php',
        'Kunnu\\Dropbox\\DropboxResponseToFile' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/DropboxResponseToFile.php',
        'Kunnu\\Dropbox\\Exceptions\\DropboxClientException' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Exceptions/DropboxClientException.php',
        'Kunnu\\Dropbox\\Http\\Clients\\DropboxGuzzleHttpClient' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Http/Clients/DropboxGuzzleHttpClient.php',
        'Kunnu\\Dropbox\\Http\\Clients\\DropboxHttpClientFactory' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Http/Clients/DropboxHttpClientFactory.php',
        'Kunnu\\Dropbox\\Http\\Clients\\DropboxHttpClientInterface' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Http/Clients/DropboxHttpClientInterface.php',
        'Kunnu\\Dropbox\\Http\\DropboxRawResponse' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Http/DropboxRawResponse.php',
        'Kunnu\\Dropbox\\Http\\RequestBodyInterface' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Http/RequestBodyInterface.php',
        'Kunnu\\Dropbox\\Http\\RequestBodyJsonEncoded' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Http/RequestBodyJsonEncoded.php',
        'Kunnu\\Dropbox\\Http\\RequestBodyStream' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Http/RequestBodyStream.php',
        'Kunnu\\Dropbox\\Models\\AccessToken' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/AccessToken.php',
        'Kunnu\\Dropbox\\Models\\Account' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/Account.php',
        'Kunnu\\Dropbox\\Models\\AccountList' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/AccountList.php',
        'Kunnu\\Dropbox\\Models\\BaseModel' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/BaseModel.php',
        'Kunnu\\Dropbox\\Models\\CopyReference' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/CopyReference.php',
        'Kunnu\\Dropbox\\Models\\DeletedMetadata' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/DeletedMetadata.php',
        'Kunnu\\Dropbox\\Models\\File' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/File.php',
        'Kunnu\\Dropbox\\Models\\FileMetadata' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/FileMetadata.php',
        'Kunnu\\Dropbox\\Models\\FileSharingInfo' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/FileSharingInfo.php',
        'Kunnu\\Dropbox\\Models\\FolderMetadata' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/FolderMetadata.php',
        'Kunnu\\Dropbox\\Models\\FolderSharingInfo' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/FolderSharingInfo.php',
        'Kunnu\\Dropbox\\Models\\MediaInfo' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/MediaInfo.php',
        'Kunnu\\Dropbox\\Models\\MediaMetadata' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/MediaMetadata.php',
        'Kunnu\\Dropbox\\Models\\MetadataCollection' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/MetadataCollection.php',
        'Kunnu\\Dropbox\\Models\\ModelCollection' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/ModelCollection.php',
        'Kunnu\\Dropbox\\Models\\ModelFactory' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/ModelFactory.php',
        'Kunnu\\Dropbox\\Models\\ModelInterface' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/ModelInterface.php',
        'Kunnu\\Dropbox\\Models\\PhotoMetadata' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/PhotoMetadata.php',
        'Kunnu\\Dropbox\\Models\\SearchResult' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/SearchResult.php',
        'Kunnu\\Dropbox\\Models\\SearchResults' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/SearchResults.php',
        'Kunnu\\Dropbox\\Models\\TemporaryLink' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/TemporaryLink.php',
        'Kunnu\\Dropbox\\Models\\Thumbnail' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/Thumbnail.php',
        'Kunnu\\Dropbox\\Models\\VideoMetadata' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Models/VideoMetadata.php',
        'Kunnu\\Dropbox\\Security\\McryptRandomStringGenerator' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Security/McryptRandomStringGenerator.php',
        'Kunnu\\Dropbox\\Security\\OpenSslRandomStringGenerator' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Security/OpenSslRandomStringGenerator.php',
        'Kunnu\\Dropbox\\Security\\RandomStringGeneratorFactory' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Security/RandomStringGeneratorFactory.php',
        'Kunnu\\Dropbox\\Security\\RandomStringGeneratorInterface' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Security/RandomStringGeneratorInterface.php',
        'Kunnu\\Dropbox\\Security\\RandomStringGeneratorTrait' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Security/RandomStringGeneratorTrait.php',
        'Kunnu\\Dropbox\\Store\\PersistentDataStoreFactory' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Store/PersistentDataStoreFactory.php',
        'Kunnu\\Dropbox\\Store\\PersistentDataStoreInterface' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Store/PersistentDataStoreInterface.php',
        'Kunnu\\Dropbox\\Store\\SessionPersistentDataStore' => __DIR__ . '/..' . '/kunalvarma05/dropbox-php-sdk/src/Dropbox/Store/SessionPersistentDataStore.php',
        'Psr\\Http\\Message\\MessageInterface' => __DIR__ . '/..' . '/psr/http-message/src/MessageInterface.php',
        'Psr\\Http\\Message\\RequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/RequestInterface.php',
        'Psr\\Http\\Message\\ResponseInterface' => __DIR__ . '/..' . '/psr/http-message/src/ResponseInterface.php',
        'Psr\\Http\\Message\\ServerRequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/ServerRequestInterface.php',
        'Psr\\Http\\Message\\StreamInterface' => __DIR__ . '/..' . '/psr/http-message/src/StreamInterface.php',
        'Psr\\Http\\Message\\UploadedFileInterface' => __DIR__ . '/..' . '/psr/http-message/src/UploadedFileInterface.php',
        'Psr\\Http\\Message\\UriInterface' => __DIR__ . '/..' . '/psr/http-message/src/UriInterface.php',
        'Symfony\\Component\\VarDumper\\Caster\\AmqpCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/AmqpCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ArgsStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ArgsStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\Caster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/Caster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ClassStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ClassStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\ConstStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ConstStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/CutArrayStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\CutStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/CutStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\DOMCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DOMCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\DateCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DateCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DoctrineCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\EnumStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/EnumStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ExceptionCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\FrameStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/FrameStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\GmpCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/GmpCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\LinkStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/LinkStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\PdoCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/PdoCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/PgSqlCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\RedisCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/RedisCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ReflectionCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ResourceCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ResourceCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\SplCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/SplCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\StubCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/StubCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/SymfonyCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\TraceStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/TraceStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/XmlReaderCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/XmlResourceCaster.php',
        'Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/AbstractCloner.php',
        'Symfony\\Component\\VarDumper\\Cloner\\ClonerInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/ClonerInterface.php',
        'Symfony\\Component\\VarDumper\\Cloner\\Cursor' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/Cursor.php',
        'Symfony\\Component\\VarDumper\\Cloner\\Data' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/Data.php',
        'Symfony\\Component\\VarDumper\\Cloner\\DumperInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/DumperInterface.php',
        'Symfony\\Component\\VarDumper\\Cloner\\Stub' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/Stub.php',
        'Symfony\\Component\\VarDumper\\Cloner\\VarCloner' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/VarCloner.php',
        'Symfony\\Component\\VarDumper\\Command\\Descriptor\\CliDescriptor' => __DIR__ . '/..' . '/symfony/var-dumper/Command/Descriptor/CliDescriptor.php',
        'Symfony\\Component\\VarDumper\\Command\\Descriptor\\DumpDescriptorInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Command/Descriptor/DumpDescriptorInterface.php',
        'Symfony\\Component\\VarDumper\\Command\\Descriptor\\HtmlDescriptor' => __DIR__ . '/..' . '/symfony/var-dumper/Command/Descriptor/HtmlDescriptor.php',
        'Symfony\\Component\\VarDumper\\Command\\ServerDumpCommand' => __DIR__ . '/..' . '/symfony/var-dumper/Command/ServerDumpCommand.php',
        'Symfony\\Component\\VarDumper\\Dumper\\AbstractDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/AbstractDumper.php',
        'Symfony\\Component\\VarDumper\\Dumper\\CliDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/CliDumper.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\CliContextProvider' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/CliContextProvider.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\ContextProviderInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/ContextProviderInterface.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\RequestContextProvider' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/RequestContextProvider.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\SourceContextProvider' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/SourceContextProvider.php',
        'Symfony\\Component\\VarDumper\\Dumper\\DataDumperInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/DataDumperInterface.php',
        'Symfony\\Component\\VarDumper\\Dumper\\HtmlDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/HtmlDumper.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ServerDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ServerDumper.php',
        'Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => __DIR__ . '/..' . '/symfony/var-dumper/Exception/ThrowingCasterException.php',
        'Symfony\\Component\\VarDumper\\Server\\Connection' => __DIR__ . '/..' . '/symfony/var-dumper/Server/Connection.php',
        'Symfony\\Component\\VarDumper\\Server\\DumpServer' => __DIR__ . '/..' . '/symfony/var-dumper/Server/DumpServer.php',
        'Symfony\\Component\\VarDumper\\VarDumper' => __DIR__ . '/..' . '/symfony/var-dumper/VarDumper.php',
        'Symfony\\Polyfill\\Mbstring\\Mbstring' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/Mbstring.php',
        'Symfony\\Polyfill\\Php72\\Php72' => __DIR__ . '/..' . '/symfony/polyfill-php72/Php72.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce29677b23f16b8eda94bac99a0deeb4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce29677b23f16b8eda94bac99a0deeb4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce29677b23f16b8eda94bac99a0deeb4::$classMap;

        }, null, ClassLoader::class);
    }
}
