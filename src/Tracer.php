<?php
namespace Neko\Libs;

use Neko\Libs\Traits\NSingleton;

/**
 * Tracer 时间打点
 */
class Tracer {
    use NSingleton;

    /**
     * @var array $timeline 时间线
     */
    protected $timeline = array();
    /**
     * @var bool 打开则不记录
     */
    protected $debug = false;

    /**
     * 打点，纪录当前时间点
     * @param string $tag 当前纪录点的名称，方便最后查看路径节点
     * @return NULL
     */
    public function mark($tag = NULL) {
        if ($this->debug){
            return ;
        }
        $backTrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT,1);
        if (empty($this->timeline)) {
            array_shift($backTrace);
        }

        $this->timeline[] = array(
            'tag' => $tag, 
            'time' => $this->getCurMicroTime(),
            'file' => isset($backTrace[0]['file']) ? $backTrace[0]['file'] : '',
            'line' => isset($backTrace[0]['line']) ? $backTrace[0]['line'] : 0,
        );
    }

    /**
     * 生成报告
     * @return array
     */
    public function getStack() {
        $stack = array();

        $preMicroTime = NULL;
        foreach ($this->timeline as $index => $item) {
            if ($preMicroTime === NULL) {
                $preMicroTime = $item['time'];
            }
            $internalTime = $item['time'] - $preMicroTime;
            $internalTime = round($internalTime/10, 1);

            $stack[] = sprintf('[#%d - %sms%s]%s(%d)',
                $index + 1, 
                $internalTime, 
                $item['tag'] !== NULL ? ' - ' . $item['tag'] : '', 
                $item['file'], 
                $item['line']
            );
        }

        return $stack;
    }

    /**
     * 获取当前毫秒时间
     * @return float
     */
    protected function getCurMicroTime() {
        return round(microtime(true) * 10000);
    }


}
