<?php
    namespace app\admin\controller;

use think\Controller;

class News extends Base
{
    public function index(){
        //获取数据 将数据填充到模板
        $data=input('param.');
        $query=http_build_query($data);
        $whereData=[];
        if(!empty($data['start_time']) && !empty($data['end_time'])
            && $data['end_time'] > $data['start_time']
        ) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if(!empty($data['catid'])) {
            $whereData['catid'] = intval($data['catid']);
        }
        if(!empty($data['title'])) {
            $whereData['title'] = ['like', '%'.$data['title'].'%'];
        }
        $this->getPageAndSize($data);


        //$news=model('News')->getNews();
        $news=model('News')->getNewsBtCondition($whereData, $this->from, $this->size);
        $total=model('News')->getNewsCountByCondition($whereData);
        $pageTotal=ceil($total/$this->size);
        return $this->fetch('',[
            'news'=>$news,
            'pageTotal'=>$pageTotal,
            'cats'=>config('cat.lists'),
            'curr'=>$this->page,
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'catid' => empty($data['catid']) ? '' : $data['catid'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'query'=>$query
        ]);
    }
    public function add(){
        if(request()->isPost()){

            $data=input('post.');
//            $isId=model('News')->get($data['id']);
//            if(!$isId){
//                return $this->result('',0,'没有该ID');
//            }
            //数据需要检验，validate验证
            //入库操作
            try {
                $res=model('News')->add($data);
            }catch (\Exception $e){
                return $this->result('',0,'新增失败');
            }
            if($res){
                return $this->result(['jump_url'=>url('news/index')],1,'OK');
            }else{
                return $this->result('',0,'新增失败');
            }

        }else{
        return $this->fetch('', [
            'cats' => config('cat.lists')
        ]);}
    }
    public function test(){
        $news=model('News')->getNews();
        echo json_encode($news);
    }
    /**
     * 编辑逻辑
     */
    public function edit($id=0){
        //$setid= pathinfo($_SERVER['REQUEST_URI'])['basename'];
        if(request()->isPost()){
            $data=input('post.');
            $tempId=$data['id'];
            unset($data['id']);
            //数据需要检验，validate验证
            //入库操作
            try {
//                $set=model('News')->save($data, ['id' => $id]);
                $res=model('News')->save($data, ['id' => $tempId]);
            }catch (\Exception $e){
                return $this->result('',0,'更新失败');
            }
            if($res){
                return $this->result(['jump_url'=>url('news/index')],1,'OK');
            }
            return $this->result('',0,$id);

        }else{
            $news=model('News')->getNewsByID($id);
            return $this->fetch('', [
                'cats' => config('cat.lists'),
                'news'=>$news,
                'id'=>$id
            ]);}
    }

}
