<?php

namespace Visualplus\LaravelApiShell;


class AnnotationParser
{
    /**
     * @param $action
     * @return array
     */
    public function parse($action)
    {
        if (count(explode('@', $action)) == 2) {
            $arr = explode('@', $action);

            return $this->parseFromAction(...$arr);
        }

        return [];
    }

    /**
     * @param $class
     * @param $method
     * @return array
     */
    public function parseFromAction($class, $method)
    {
        $rc = new \ReflectionClass($class);
        $data = [];

        $comments = $rc->getMethod($method)->getDocComment();
        preg_match_all('/@(\w+)\s(.*)\r/', $comments, $matches);

        for ($i = 0; $i < count($matches[0]); $i ++) {
            $data[] = [
                $matches[1][$i] => $matches[2][$i]
            ];
        }

        return $data;
    }
}