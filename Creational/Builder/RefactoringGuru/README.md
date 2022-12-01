# Builder in PHP

**Builder, karmaşık nesnelerin adım adım inşa edilmesini sağlayan yaratıcı bir tasarım modelidir.**

## Kullanım örnekleri: 
- Builder kalıbı, PHP dünyasında iyi bilinen bir kalıptır. Pek çok olası yapılandırma seçeneğine sahip bir nesne oluşturmanız gerektiğinde özellikle kullanışlıdır. 
## Tanımlama: 
- Builder modeli, tek bir oluşturma yöntemine ve elde edilen nesneyi yapılandırmak için çeşitli yöntemlere sahip bir sınıfta tanınabilir. Oluşturucu yöntemleri genellikle zincirlemeyi destekler (örneğin, someBuilder->setValueA(1)->setValueB(2)->create()).

## Kavramsal Örnek 

Bu örnek, Oluşturucu tasarım modelinin yapısını gösterir ve aşağıdaki sorulara odaklanır: 
- Hangi sınıflardan oluşur? 
- Bu sınıflar hangi rolleri oynuyor? -
- Modelin öğeleri nasıl ilişkilidir? 

Kalıbın yapısını öğrendikten sonra, gerçek dünyadan bir PHP kullanım senaryosuna dayanan aşağıdaki örneği kavramanız daha kolay olacaktır.

## Gerçek Dünya Örneği 

Builder modelinin en iyi uygulamalarından biri bir SQL sorgu oluşturucusudur. Oluşturucu arabirimi, genel bir SQL sorgusu oluşturmak için gereken ortak adımları tanımlar. Öte yandan, farklı SQL lehçelerine karşılık gelen beton oluşturucular, belirli bir veritabanı motorunda yürütülebilen SQL sorgularının bölümlerini döndürerek bu adımları uygular.