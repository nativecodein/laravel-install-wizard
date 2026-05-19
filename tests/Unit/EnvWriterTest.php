<?php

namespace Nativecodein\LaravelInstallWizard\Tests\Unit;

use Nativecodein\LaravelInstallWizard\Services\EnvWriter;
use PHPUnit\Framework\TestCase;

class EnvWriterTest extends TestCase
{
    protected string $path;

    protected function setUp(): void
    {
        parent::setUp();
        $this->path = tempnam(sys_get_temp_dir(), 'envw');
        file_put_contents($this->path, "APP_NAME=Old\n# A comment\nAPP_ENV=local\nUNRELATED=keepme\n");
    }

    protected function tearDown(): void
    {
        @unlink($this->path);
    }

    public function test_writes_and_preserves_existing_keys_and_comments(): void
    {
        $writer = new EnvWriter($this->path);

        $writer->write([
            'APP_NAME' => 'NativeCode',
            'NEW_KEY'  => 'value',
        ]);

        $contents = file_get_contents($this->path);

        $this->assertStringContainsString('APP_NAME=NativeCode', $contents);
        $this->assertStringContainsString('# A comment', $contents);
        $this->assertStringContainsString('APP_ENV=local', $contents);
        $this->assertStringContainsString('UNRELATED=keepme', $contents);
        $this->assertStringContainsString('NEW_KEY=value', $contents);
    }

    public function test_quotes_values_with_spaces(): void
    {
        $writer = new EnvWriter($this->path);

        $writer->write(['APP_NAME' => 'My App']);

        $contents = file_get_contents($this->path);
        $this->assertStringContainsString('APP_NAME="My App"', $contents);
    }

    public function test_rejects_invalid_keys(): void
    {
        $writer = new EnvWriter($this->path);

        $writer->write(['lowercase_key' => 'x', 'BAD-KEY' => 'y']);

        $contents = file_get_contents($this->path);
        $this->assertStringNotContainsString('lowercase_key', $contents);
        $this->assertStringNotContainsString('BAD-KEY', $contents);
    }

    public function test_reads_existing_values(): void
    {
        $values = (new EnvWriter($this->path))->all();

        $this->assertSame('Old', $values['APP_NAME']);
        $this->assertSame('local', $values['APP_ENV']);
        $this->assertSame('keepme', $values['UNRELATED']);
    }
}
