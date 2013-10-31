<?php
namespace Aura\Html\Helper;

/**
 * Test class for Scripts.
 * Generated by PHPUnit on 2011-04-02 at 08:29:01.
 */
class ScriptsTest extends AbstractHelperTest
{
    public function test__invoke()
    {
        $scripts = $this->helper;
        $actual = $scripts();
        $this->assertInstanceOf('Aura\Html\Helper\Scripts', $actual);
    }
    
    public function testSetIndent()
    {
        $scripts = $this->helper;
        $scripts->setIndent('  ');
        $scripts->add('/js/first.js');
        $scripts->add('/js/middle.js');
        $scripts->add('/js/last.js');
        
        $actual = $scripts->get();
        
        $expect = '  <script src="/js/first.js" type="text/javascript"></script>' . PHP_EOL
                . '  <script src="/js/middle.js" type="text/javascript"></script>' . PHP_EOL
                . '  <script src="/js/last.js" type="text/javascript"></script>' . PHP_EOL;
        
        $this->assertSame($expect, $actual);
    }

    public function testAddAndGet()
    {
        $scripts = $this->helper;
        $scripts->add('/js/last.js', array(), 150);
        $scripts->add('/js/first.js', array(), 50);
        $scripts->add('/js/middle.js');
        $scripts->addCond('ie6', '/js/ie6.js');
        
        $actual = $scripts->get();
        
        $expect = '    <script src="/js/first.js" type="text/javascript"></script>' . PHP_EOL
                . '    <script src="/js/middle.js" type="text/javascript"></script>' . PHP_EOL
                . '    <!--[if ie6]><script src="/js/ie6.js" type="text/javascript"></script><![endif]-->' . PHP_EOL
                . '    <script src="/js/last.js" type="text/javascript"></script>' . PHP_EOL;
        
        $this->assertSame($expect, $actual);
    }
}
