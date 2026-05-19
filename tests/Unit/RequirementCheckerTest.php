<?php

namespace Nativecodein\LaravelInstallWizard\Tests\Unit;

use Nativecodein\LaravelInstallWizard\Services\RequirementChecker;
use PHPUnit\Framework\TestCase;

class RequirementCheckerTest extends TestCase
{
    public function test_reports_loaded_and_missing_extensions(): void
    {
        $checker = new RequirementChecker([
            'required_extensions' => ['pcre', 'this_extension_definitely_does_not_exist_xyz'],
            'writable_paths'      => [],
        ]);

        $exts = $checker->extensions();

        $this->assertSame('pcre', $exts[0]['name']);
        $this->assertTrue($exts[0]['loaded']);

        $this->assertSame('this_extension_definitely_does_not_exist_xyz', $exts[1]['name']);
        $this->assertFalse($exts[1]['loaded']);

        $this->assertCount(1, $checker->missingExtensions());
        $this->assertFalse($checker->allExtensionsLoaded());
    }

    public function test_reports_writable_paths(): void
    {
        $tmp = sys_get_temp_dir();

        $checker = new RequirementChecker([
            'required_extensions' => [],
            'writable_paths'      => [$tmp],
        ]);

        $paths = $checker->permissions();

        $this->assertSame($tmp, $paths[0]['path']);
        $this->assertTrue($paths[0]['exists']);
        $this->assertTrue($paths[0]['writable']);
        $this->assertTrue($checker->allPathsWritable());
    }
}
