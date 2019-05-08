# Monolog RotatingFileHandler for Magento 2

## Installation

```
composer require lavoweb/rotatingfilehandler
```

## Example

### Usage

```
<?php

namespace Namespace\Module\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Namespace\Module\Logger\Logger;

class GenerateFiduid extends AbstractHelper
{
    /** @var Logger */
    protected $logger;

    /**
     * GenerateFiduid constructor.
     *
     * @param Context $context
     * @param Logger  $logger
     */
    public function __construct(Context $context, Logger $logger)
    {
        parent::__construct($context);
        $this->logger = $logger;
    }

    /**
     * Generate
     */
    public function generate()
    {
        $this->logger->info("begin generation);
    }
}
```

### Simple

Log will be available at that path: __/var/log/fiduid-2019-05-08.log__, keep one week.

__src/app/code/Namespace/Module/etc/di.xml__
```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/ObjectManager/etc/config.xsd">
    <type name="Namespace\Module\Logger\Handler">
        <arguments>
            <argument name="filename" xsi:type="string">fiduid.log</argument>
            <argument name="maxFiles" xsi:type="number">7</argument>
        </arguments>
    </type>
    <type name="Namespace\Module\Logger\Logger">
        <arguments>
            <argument name="name" xsi:type="string">lw_fiduid</argument>
            <argument name="handlers"  xsi:type="array">
                <item name="system" xsi:type="object">Namespace\Module\Logger\Handler</item>
            </argument>
        </arguments>
    </type>
</config>
```

__src/app/code/Namespace/Module/Logger/Handler.php__
```
<?php

namespace Namespace\Module\Logger;

use LavoWeb\RotatingFileHandler\Logger\Handler as RotatingHandler;

class Handler extends RotatingHandler
{
    // Empty
}
```

__src/app/code/Namespace/Module/Logger/Logger.php__
```
<?php

namespace Namespace\Module\Logger;

use LavoWeb\RotatingFileHandler\Logger\Logger as RotatingLogger;

class Logger extends RotatingLogger
{
    // Empty
}
```

### Complex

Log will be available at that path: __/var/log/2019/05/08-fiduid.log__, keep forever.

__src/app/code/Namespace/Module/etc/di.xml__
```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/ObjectManager/etc/config.xsd">
    <type name="Namespace\Module\Logger\Handler">
        <arguments>
            <argument name="filename" xsi:type="string">fiduid.log</argument>
            <argument name="filenameFormat" xsi:type="string">{date}-{filename}</argument>
            <argument name="dateFormat" xsi:type="string">Y/m/d</argument>
        </arguments>
    </type>
    <type name="Namespace\Module\Logger\Logger">
        <arguments>
            <argument name="name" xsi:type="string">lw_fiduid</argument>
            <argument name="handlers"  xsi:type="array">
                <item name="system" xsi:type="object">Namespace\Module\Logger\Handler</item>
            </argument>
        </arguments>
    </type>
</config>
```

__src/app/code/Namespace/Module/Logger/Handler.php__
```
<?php

namespace Namespace\Module\Logger;

use LavoWeb\RotatingFileHandler\Logger\Handler as RotatingHandler;

class Handler extends RotatingHandler
{
    // Empty
}
```

__src/app/code/Namespace/Module/Logger/Logger.php__
```
<?php

namespace Namespace\Module\Logger;

use LavoWeb\RotatingFileHandler\Logger\Logger as RotatingLogger;

class Logger extends RotatingLogger
{
    // Empty
}
```