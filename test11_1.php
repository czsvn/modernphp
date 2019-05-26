<?php
/**
 * 自定义过滤器page 108
 * @author Lenovo
 *
 */
class DirtyWordsFilter extends php_user_filter
{
    /**
     * 
     * @param resource $in     流来的桶队列
     * @param resource $out    流走的桶队列
     * @param int $consumed    处理的字节数
     * @param bool $closing    是流中的最后一个桶队列吗？
     */
    public function filter($in, $out, &$consumed, $closing) 
    {
        $words = array('grime', 'dirt', 'grease');
        $wordData = array();
        foreach ($words as $word) {
            $wordData[$word] = str_repeat('*', strlen($word));
        }
        $bad = array_keys($wordData);
        $good = array_values($wordData);
        
        //迭代流来的桶队列中的每个桶
        while ($bucket = stream_bucket_make_writeable($in)) {
            //审查桶数据中的脏字            
            $bucket->data = str_replace($bad, $good, $bucket->data);
            
            //增加已处理的数据量
            $consumed += $bucket->datalen;
            
            //把桶放入流向下游的队列中
            stream_bucket_append($out, $bucket);
        }
        
        return PSFS_PASS_ON;
    }
}

stream_filter_register('dirty_words_filter', 'DirtyWordsFilter');

$handle = fopen('data.txt', 'rb');
stream_filter_append($handle, 'dirty_words_filter');
while (feof($handle) !== true) {
    echo fgets($handle), PHP_EOL;
}
fclose($handle);