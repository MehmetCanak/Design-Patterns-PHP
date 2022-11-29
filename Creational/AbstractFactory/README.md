# `Abstract Factory`

**Abstract Factory, somut sınıflarını belirtmeden ilgili nesne aileleri oluşturmanıza olanak tanıyan yaratıcı bir tasarım modelidir.**

![alt text](https://refactoring.guru/images/patterns/content/abstract-factory/abstract-factory-en.png "Abstract Factory")


## Sorun 

Bir mobilya mağazası simülatörü oluşturduğunuzu hayal edin. Kodunuz aşağıdakileri temsil eden sınıflardan oluşur:

1. Bir ilgili ürün ailesi, örneğin: Sandalye + Kanepe + Sehpa.
2. Bu ailenin birkaç çeşidi. Örneğin, Sandalye + Kanepe + Sehpa ürünleri şu varyantlarda mevcuttur: Modern, Victorian, ArtDeco.

![alt text](https://refactoring.guru/images/patterns/diagrams/abstract-factory/problem-en.png "Abstract Factory")

Aynı ailedeki diğer nesnelerle eşleşmeleri için ayrı ayrı mobilya nesneleri yaratmanın bir yoluna ihtiyacınız var. Eşleşmeyen mobilyalar aldıklarında müşteriler oldukça kızıyor.

![alt text](https://refactoring.guru/images/patterns/content/abstract-factory/abstract-factory-comic-1-en.png "Abstract Factory")

Ayrıca, programa yeni ürünler veya ürün aileleri eklerken mevcut kodu değiştirmek istemezsiniz. Mobilya satıcıları kataloglarını çok sık günceller ve bu her gerçekleştiğinde temel kodu değiştirmek istemezsiniz.

## Çözüm 

Soyut Fabrika modelinin önerdiği ilk şey, ürün ailesinin her bir farklı ürünü (örneğin, sandalye, kanepe veya sehpa) için arayüzleri açıkça beyan etmektir. Ardından, tüm ürün varyantlarının bu arayüzleri takip etmesini sağlayabilirsiniz. Örneğin, tüm sandalye varyantları, Sandalye arayüzünü uygulayabilir; tüm sehpa varyantları CoffeeTable arabirimini vb. uygulayabilir.


![alt text](https://refactoring.guru/images/patterns/diagrams/abstract-factory/solution1.png "Abstract Factory")

Bir sonraki adım, ürün ailesinin parçası olan tüm ürünler için (örneğin, createChair, createSofa ve createCoffeeTable) oluşturma yöntemlerinin listesini içeren bir arayüz olan Abstract Factory'yi ilan etmektir. Bu yöntemler, daha önce çıkardığımız arabirimlerle temsil edilen soyut ürün türlerini döndürmelidir: Sandalye, Kanepe, Kahve Masası vb.


![alt text](https://refactoring.guru/images/patterns/diagrams/abstract-factory/solution2.png "Abstract Factory")

Şimdi, ürün varyantlarına ne dersiniz? Bir ürün ailesinin her varyantı için, AbstractFactory arayüzüne dayalı olarak ayrı bir fabrika sınıfı oluşturuyoruz. Bir fabrika, belirli türden ürünleri iade eden bir sınıftır. Örneğin, ModernFurnitureFactory yalnızca ModernChair, ModernSofa ve ModernCoffeeTable nesneleri oluşturabilir.

İstemci kodu, ilgili abstract arayüzleri aracılığıyla hem fabrikalar hem de ürünlerle çalışmak zorundadır. Bu, gerçek müşteri kodunu bozmadan müşteri koduna ilettiğiniz fabrika tipini ve müşteri kodunun aldığı ürün çeşidini değiştirmenize olanak tanır.

![alt text](https://refactoring.guru/images/patterns/content/abstract-factory/abstract-factory-comic-2-en.png "Abstract Factory")

Diyelim ki müşteri bir fabrikanın sandalye üretmesini istiyor. Müşterinin fabrikanın sınıfından haberdar olması gerekmediği gibi ne tür bir sandalye aldığı da önemli değil. İster Modern bir model ister Viktorya tarzı bir sandalye olsun, müşteri soyut Sandalye arayüzünü kullanarak tüm sandalyelere aynı şekilde davranmalıdır. Bu yaklaşımla, müşterinin sandalye hakkında bildiği tek şey, sitOn yöntemini bir şekilde uyguladığıdır. Ayrıca, sandalyenin hangi çeşidi iade edilirse edilsin, her zaman aynı fabrika nesnesi tarafından üretilen kanepe veya sehpa tipiyle eşleşecektir.

Açıklığa kavuşturulması gereken bir şey daha kaldı: Müşteri yalnızca abstract arayüzlere maruz kalıyorsa, gerçek fabrika nesnelerini yaratan nedir? Genellikle uygulama, başlatma aşamasında somut bir fabrika nesnesi oluşturur. Bundan hemen önce uygulama, yapılandırmaya veya ortam ayarlarına bağlı olarak fabrika tipini seçmelidir.

##  Structure

![alt text](https://refactoring.guru/images/patterns/diagrams/abstract-factory/structure.png "Abstract Factory")

1. Özet Ürünler, bir ürün ailesini oluşturan bir dizi farklı ancak ilgili ürün için arayüzler beyan eder.

2. Somut Ürünler, varyantlara göre gruplandırılmış soyut ürünlerin çeşitli uygulamalarıdır. Her soyut ürün (sandalye/kanepe) verilen tüm varyantlarda (Victoria Dönemi/Modern) uygulanmalıdır.

3. Soyut Fabrika arabirimi, soyut ürünlerin her birini oluşturmak için bir dizi yöntem bildirir.

4. Concrete Factories, soyut fabrikanın yaratım yöntemlerini uygular. Her Concrete Factories, belirli bir ürün varyantına karşılık gelir ve yalnızca bu ürün varyantlarını oluşturur.

5. concrete fabrikaları somut ürünler oluştursa da, yaratma yöntemlerinin imzaları, karşılık gelen soyut ürünleri döndürmelidir. Bu şekilde, bir fabrikayı kullanan client kodu, bir fabrikadan aldığı ürünün belirli varyantına bağlanmaz. İstemci, nesneleriyle soyut arayüzler aracılığıyla iletişim kurduğu sürece, herhangi bir somut fabrika/ürün varyantı ile çalışabilir.

## Sözde kod 

Bu örnek, oluşturulan tüm öğeleri seçilen bir işletim sistemiyle tutarlı tutarken, istemci kodunu somut UI sınıflarına bağlamadan platformlar arası UI öğeleri oluşturmak için Soyut Fabrika modelinin nasıl kullanılabileceğini göstermektedir.

![alt text](https://refactoring.guru/images/patterns/diagrams/abstract-factory/example.png "Abstract Factory")

Platformlar arası bir uygulamadaki aynı UI öğelerinin benzer şekilde davranması, ancak farklı işletim sistemlerinde biraz farklı görünmesi beklenir. Ayrıca, kullanıcı arabirimi öğelerinin mevcut işletim sisteminin stiliyle eşleştiğinden emin olmak sizin işiniz. Programınızın Windows'ta çalıştırıldığında macOS denetimlerini işlemesini istemezsiniz.

Abstract Factory arabirimi, istemci kodunun farklı türde UI öğeleri üretmek için kullanabileceği bir dizi oluşturma yöntemi bildirir. Beton fabrikaları, belirli işletim sistemlerine karşılık gelir ve söz konusu işletim sistemiyle eşleşen UI öğelerini oluşturur.

Şu şekilde çalışır: Bir uygulama başladığında mevcut işletim sisteminin türünü kontrol eder. Uygulama, işletim sistemiyle eşleşen bir sınıftan bir fabrika nesnesi oluşturmak için bu bilgileri kullanır. Kodun geri kalanı, kullanıcı arabirimi öğeleri oluşturmak için bu fabrikayı kullanır. Bu, yanlış öğelerin oluşturulmasını önler.

Bu yaklaşımla, müşteri kodu, soyut arayüzleri aracılığıyla bu nesnelerle çalıştığı sürece fabrikaların somut sınıflarına ve UI öğelerine bağlı değildir. Bu aynı zamanda müşteri kodunun gelecekte ekleyebileceğiniz diğer fabrikaları veya kullanıcı arabirimi öğelerini desteklemesine de olanak tanır.

Sonuç olarak, uygulamanıza her yeni kullanıcı arabirimi öğesi varyasyonu eklediğinizde istemci kodunu değiştirmeniz gerekmez. Tek yapmanız gereken, bu öğeleri üreten yeni bir fabrika sınıfı oluşturmak ve uygulamanın başlatma kodunu biraz değiştirerek uygun olduğunda o sınıfı seçmesi.

```java

// The abstract factory interface declares a set of methods that
// return different abstract products. These products are called
// a family and are related by a high-level theme or concept.
// Products of one family are usually able to collaborate among
// themselves. A family of products may have several variants,
// but the products of one variant are incompatible with the
// products of another variant.
interface GUIFactory is
    method createButton():Button
    method createCheckbox():Checkbox


// Concrete factories produce a family of products that belong
// to a single variant. The factory guarantees that the
// resulting products are compatible. Signatures of the concrete
// factory's methods return an abstract product, while inside
// the method a concrete product is instantiated.
class WinFactory implements GUIFactory is
    method createButton():Button is
        return new WinButton()
    method createCheckbox():Checkbox is
        return new WinCheckbox()

// Each concrete factory has a corresponding product variant.
class MacFactory implements GUIFactory is
    method createButton():Button is
        return new MacButton()
    method createCheckbox():Checkbox is
        return new MacCheckbox()


// Each distinct product of a product family should have a base
// interface. All variants of the product must implement this
// interface.
interface Button is
    method paint()

// Concrete products are created by corresponding concrete
// factories.
class WinButton implements Button is
    method paint() is
        // Render a button in Windows style.

class MacButton implements Button is
    method paint() is
        // Render a button in macOS style.

// Here's the base interface of another product. All products
// can interact with each other, but proper interaction is
// possible only between products of the same concrete variant.
interface Checkbox is
    method paint()

class WinCheckbox implements Checkbox is
    method paint() is
        // Render a checkbox in Windows style.

class MacCheckbox implements Checkbox is
    method paint() is
        // Render a checkbox in macOS style.


// The client code works with factories and products only
// through abstract types: GUIFactory, Button and Checkbox. This
// lets you pass any factory or product subclass to the client
// code without breaking it.
class Application is
    private field factory: GUIFactory
    private field button: Button
    constructor Application(factory: GUIFactory) is
        this.factory = factory
    method createUI() is
        this.button = factory.createButton()
    method paint() is
        button.paint()


// The application picks the factory type depending on the
// current configuration or environment settings and creates it
// at runtime (usually at the initialization stage).
class ApplicationConfigurator is
    method main() is
        config = readApplicationConfigFile()

        if (config.OS == "Windows") then
            factory = new WinFactory()
        else if (config.OS == "Mac") then
            factory = new MacFactory()
        else
            throw new Exception("Error! Unknown operating system.")

        Application app = new Application(factory)

```

## Uygulanabilirlik 

**Kodunuzun çeşitli ilgili ürün aileleriyle çalışması gerektiğinde, ancak bu ürünlerin somut sınıflarına bağlı olmasını istemediğinizde Soyut Fabrika'yı kullanın; bunlar önceden bilinmiyor olabilir veya yalnızca gelecekte genişletilebilirliğe izin vermek istersiniz.**

Soyut Fabrika size ürün ailesinin her sınıfından nesneler yaratmanız için bir arayüz sağlar. Kodunuz bu arabirim aracılığıyla nesneler oluşturduğu sürece, uygulamanız tarafından zaten oluşturulmuş ürünlerle eşleşmeyen bir ürünün yanlış varyantını oluşturma konusunda endişelenmenize gerek yoktur.

- Birincil sorumluluğunu bulanıklaştıran bir dizi Fabrika Yöntemine sahip bir sınıfınız olduğunda Soyut Fabrikayı uygulamayı düşünün.
- İyi tasarlanmış bir programda her sınıf tek bir şeyden sorumludur. Bir sınıf birden fazla ürün türüyle uğraştığında, fabrika yöntemlerini bağımsız bir fabrika sınıfına veya tam gelişmiş bir Soyut Fabrika uygulamasına çıkarmaya değer olabilir.

## Nasıl Uygulanır?

1. Bu ürünlerin varyantlarına karşı farklı ürün türlerinin bir matrisini çıkarın.
2. Tüm ürün türleri için soyut ürün arayüzleri bildirin. Ardından, tüm somut ürün sınıflarının bu arabirimleri uygulamasını sağlayın.
3. Tüm soyut ürünler için bir dizi oluşturma yöntemiyle soyut fabrika arayüzünü bildirin.
4. Her ürün varyantı için bir tane olmak üzere bir dizi somut fabrika sınıfı uygulayın.
5. Uygulamada bir yerde fabrika başlatma kodu oluşturun. Uygulama konfigürasyonuna veya mevcut ortama bağlı olarak somut fabrika sınıflarından birini başlatmalıdır. Bu fabrika nesnesini, ürünleri oluşturan tüm sınıflara iletin.
6. Kodu tarayın ve ürün kurucularına yapılan tüm doğrudan çağrıları bulun. Bunları, fabrika nesnesinde uygun oluşturma yöntemine yapılan çağrılarla değiştirin.

##  Pros and Cons (Lehte ve aleyhte olanlar)

### Pros

- Bir fabrikadan aldığınız ürünlerin birbiri ile uyumlu olduğundan emin olabilirsiniz. 
- Somut ürünler ve client kodu arasındaki sıkı bağlantıdan kaçınırsınız. 
- Tek Sorumluluk İlkesi. Ürün oluşturma kodunu tek bir yere çıkararak kodun desteklenmesini kolaylaştırabilirsiniz. 
- Açık/Kapalı İlkesi. Mevcut müşteri kodunu bozmadan yeni ürün çeşitlerini tanıtabilirsiniz.


### Cons

- Modelle birlikte birçok yeni arayüz ve sınıf tanıtıldığı için kod olması gerekenden daha karmaşık hale gelebilir.

### Diğer Kalıplarla İlişkiler

Pek çok tasarım, Fabrika Yöntemi (alt sınıflar aracılığıyla daha az karmaşık ve daha özelleştirilebilir) kullanılarak başlar ve Abstract Factory, Prototip veya Builder a (daha esnek, ancak daha karmaşık) doğru gelişir.

Builder, adım adım karmaşık nesneler oluşturmaya odaklanır. Abstract Factory, ilgili nesnelerin ailelerini oluşturma konusunda uzmanlaşmıştır. Abstract Factory ürünü hemen iade ederken, Builder ürünü getirmeden önce bazı ek yapım adımlarını uygulamanıza izin verir.

Abstract Factory sınıfları genellikle bir dizi Fabrika Yöntemine dayalıdır, ancak bu sınıflardaki yöntemleri oluşturmak için Prototip'i de kullanabilirsiniz.

Yalnızca alt sistem nesnelerinin istemci kodundan oluşturulma şeklini gizlemek istediğinizde Abstract Factory, Facade'e bir alternatif olarak hizmet edebilir.

Abstract Factory'yi Bridge ile birlikte kullanabilirsiniz. Bu eşleştirme, Bridge tarafından tanımlanan bazı soyutlamalar yalnızca belirli uygulamalarla çalışabildiğinde kullanışlıdır. Bu durumda, Abstract Factory bu ilişkileri kapsülleyebilir ve karmaşıklığı istemci kodundan gizleyebilir.

Abstract Factories, Builders ve Prototiplerin tümü Singleton olarak uygulanabilir.



