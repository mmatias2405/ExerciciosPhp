<?php

namespace Galoa\ExerciciosPhp\Tests\TextWrap;

use Galoa\ExerciciosPhp\TextWrap\Resolucao;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Galoa\ExerciciosPhp\TextWrap\Resolucao.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp() {
    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    $this->spacedString = "   Se   vi   mais   longe   foi   por estar   de   pé   sobre   ombros   de   gigantes  ";
    $this->bigString = "Nenhuma grande descoberta foi feita jamais sem um palpite ousado";
  }

  /**
   * Checa o retorno para strings vazias.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->textWrap("", 2018);
    $this->assertCount(1, $ret);
    $this->assertEmpty($ret[0]);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertCount(10, $ret);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi por", $ret[3]);
    $this->assertEquals("estar de", $ret[4]);
    $this->assertEquals("pé", $ret[5]);
    $this->assertEquals("sobre", $ret[6]);
    $this->assertEquals("ombros", $ret[7]);
    $this->assertEquals("de", $ret[8]);
    $this->assertEquals("gigantes", $ret[9]);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 12);
    $this->assertCount(6, $ret);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
  }

  /**
   * Testa a quebra de palavras quando o length é pequeno.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallLength() {
    $ret = $this->resolucao->textWrap($this->baseString, 4);
    $this->assertCount(17, $ret);
    $this->assertEquals("Se", $ret[0]);
    $this->assertEquals("vi", $ret[1]);
    $this->assertEquals("mais", $ret[2]);
    $this->assertEquals("long", $ret[3]);
    $this->assertEquals("e", $ret[4]);
    $this->assertEquals("foi", $ret[5]);
    $this->assertEquals("por", $ret[6]);
    $this->assertEquals("esta", $ret[7]);
    $this->assertEquals("r de", $ret[8]);
    $this->assertEquals("pé", $ret[9]);
    $this->assertEquals("sobr", $ret[10]);
    $this->assertEquals("e", $ret[11]);  
    $this->assertEquals("ombr", $ret[12]);
    $this->assertEquals("os", $ret[13]);
    $this->assertEquals("de", $ret[14]);
    $this->assertEquals("giga", $ret[15]);
    $this->assertEquals("ntes", $ret[16]);  
  }

  /**
   * Testa a quebra de linha para length grande.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForBigLength() {
    $ret = $this->resolucao->textWrap($this->baseString, 20);
    $this->assertCount(4, $ret);
    $this->assertEquals("Se vi mais longe foi", $ret[0]);
    $this->assertEquals("por estar de pé", $ret[1]);
    $this->assertEquals("sobre ombros de", $ret[2]);
    $this->assertEquals("gigantes", $ret[3]);
  }      
    
  /**
   * Testa a quebra de linha para uma string espaçamento a mais no inicio, no fim e entre as palavras.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testSpacedString() {
    $ret = $this->resolucao->textWrap($this->spacedString, 12);
    $this->assertCount(6, $ret);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
  }

  /**
   * Testa a quebra de linha para palavras mais longas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testBigWords() {
    $ret = $this->resolucao->textWrap($this->bigString, 10);
    $this->assertCount(7, $ret);
    $this->assertEquals("Nenhuma", $ret[0]);
    $this->assertEquals("grande", $ret[1]);
    $this->assertEquals("descoberta", $ret[2]);
    $this->assertEquals("foi feita", $ret[3]);
    $this->assertEquals("jamais sem", $ret[4]);
    $this->assertEquals("um palpite", $ret[5]);
    $this->assertEquals("ousado", $ret[6]);  
  }

  /**
   * Testa a quebra de linha e de palavras para uma frase com palavras garndes e length pequeno.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testBigWords2() {
    $ret = $this->resolucao->textWrap($this->bigString, 5);
    $this->assertCount(15, $ret);
    $this->assertEquals("Nenhu", $ret[0]);
    $this->assertEquals("ma", $ret[1]);
    $this->assertEquals("grand", $ret[2]);
    $this->assertEquals("e", $ret[3]);
    $this->assertEquals("desco", $ret[4]);
    $this->assertEquals("berta", $ret[5]);
    $this->assertEquals("foi", $ret[6]);
    $this->assertEquals("feita", $ret[7]);
    $this->assertEquals("jamai", $ret[8]);
    $this->assertEquals("s sem", $ret[9]);
    $this->assertEquals("um", $ret[10]);
    $this->assertEquals("palpi", $ret[11]);
    $this->assertEquals("te", $ret[12]);
    $this->assertEquals("ousad", $ret[13]);
    $this->assertEquals("o", $ret[14]);
  }      
}
