<?php
namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\PostInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Optix\Media\MediaUploader;

use function PHPSTORM_META\map;

class PostRepository extends BaseRepository implements PostInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

    public function create(array $attributes, User $user=null )
    {
        DB::beginTransaction();

        $post =""; 

        try {
            
            // create post
            $post = $user->posts()->create($attributes);
            

            // handling tags

            //get hashtags
            $hashatgs = $this->get_hashtags($post->body);

            if( count($hashatgs) >  0){
                
                // create tag
                foreach ($hashatgs as  $index => $tag) {
                  
                    $tags[] = Tag::firstOrCreate(['tag_name' => $tag]);
                }
              
              
                // attach to post
                $post->tags()->saveMany( $tags);
              
            };
            
           
           
           
            // assign collection if media
            if( isset($attributes['medias'])) {
                
                foreach ($attributes['medias'] as $key => $photo) {

                    // create & store image
                    $media = MediaUploader::fromFile( $photo)
                    ->useFileName($post->id.'-collection-'.$key.'.'.$photo->extension())
                    ->useName($post->id.'-collection-'.$key)
                    ->upload();

                    //attatch to account
                    $post->attachMedia($media, 'collection');
    
                  
                } 
            }
            

        } catch(\Exception $e)
        {
            DB::rollback();
            throw new Exception($e->getMessage());
            // return back()->withError($e->getMessage());
        }
        
        DB::commit();
        
        return  $post->fresh();
    }// end of create funciton


    function get_hashtags($string) {
        
        /* Match hashtags */
    
        preg_match_all('/#(\w+)/', $string, $matches);
    
        
    
        /* Add all matches to array */
        $keywords=[];
        foreach ($matches[1] as $match) {
    
            $keywords[] = $match;
    
        }
    
        
    
        return (array) $keywords;
    
    }

   
    public function update(int $postId = null, array $attributes, User $user=null )
    {
        DB::beginTransaction();

        $post =""; 
        
        try {
            
            // find post
            $postId = ($postId == null ) ? $this->model->id : $postId;
            $post = Post::findOrFail($postId);
            


            // update post
            $post->update($attributes);



            // handling tags

            // 1. get hashtags
            $hashatgs = $this->get_hashtags($post->body);
           
            // 2. create new tag if not exist
            if( count($hashatgs) >  0){
                
                // create tag
                foreach ($hashatgs as  $index => $tag) {
                  
                    $tags[] = Tag::firstOrCreate(['tag_name' => $tag]);
                }

              
                // attach post's tags
                $post->tags()->detach();
                $post->tags()->saveMany($tags);
              
            };
        

            
            // assign collection medias
            //
            // if there is media
            if( isset($attributes['medias'])) {
                
                foreach ($attributes['medias'] as $key => $photo) {

                    // create & store image
                    $media = MediaUploader::fromFile( $photo)
                    ->useFileName($post->id.'-collection-'.$key.'.'.$photo->extension())
                    ->useName($post->id.'-collection-'.$key)
                    ->upload();

                       //attatch to account
                    $post->attachMedia($media, 'collection');
    
                  
                } 
            }
            

        } catch(\Exception $e)
        
        {
            DB::rollback();
            throw  new Exception($e->getMessage());
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return  $post;
    }

   

  
}
