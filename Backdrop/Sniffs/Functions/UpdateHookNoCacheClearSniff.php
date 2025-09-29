<?php
/**
 * @file
 * Make sure that no cache flushing happens while updates get applied.
 */

namespace Backdrop\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Sniff or cache flushing inside update hooks.
 */
class UpdateHookNoCacheClearSniff implements Sniff {

  /**
   * Returns an array of tokens this test wants to listen for.
   *
   * @return array<int|string>
   */
  public function register() {
    return [T_STRING];
  }//end register()

  /**
   * Processes this test, when one of its tokens is encountered.
   *
   * @param \PHP_CodeSniffer\Files\File $phpcsFile
   *   The file being scanned.
   * @param int $stackPtr
   *   The position of the current token in the stack passed in $tokens.
   *
   * @return void
   */
  public function process(File $phpcsFile, $stackPtr)  {
    $tokens = $phpcsFile->getTokens();

    // We only care about install files.
    $path_parts = pathinfo($phpcsFile->path);
    if ($path_parts['extension'] != 'install') {
      return;
    }

    // We don't care about top level functions.
    if (empty($tokens[$stackPtr]['level'])) {
      return;
    }

    $forbidden = array(
      'backdrop_flush_all_caches',
      'cache_clear_all',
      'cache_flush',
    );
    $function_name = $tokens[$stackPtr]['content'];
    if (in_array($function_name, $forbidden)) {
      // Array keys in conditions are token positions.
      $parents = array_keys($tokens[$stackPtr]['conditions']);
      // The first one is the topmost (level 0) we need.
      $parent_pos = reset($parents);

      $parent_name_pos = $phpcsFile->findNext(T_STRING, $parent_pos);
      $parent_function_name = $tokens[$parent_name_pos]['content'];

      if (preg_match('/.+_update_\d+/', $parent_function_name)) {
        $error = 'Flushing caches in update hooks disrupts upgrade processing. Remove %s() from %s().';
        $placeholders = [$function_name, $parent_function_name];
        $phpcsFile->addError($error, $stackPtr, 'NoCacheClear', $placeholders);
      }
    }

  }//end process()

}//end class
